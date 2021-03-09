<template>
    <div>

        <quick-post-form :user="this.user"></quick-post-form>           

        <div class="quickposts">
            <transition-group name="fade">
                <div v-for="quickpost in quickposts" :key="quickpost.id" class="quick-post">
                    <div class="quickpost-header">
                        <div>
                            <user-avatar
                            :user="user" 
                            :base-url="url"
                            ></user-avatar>

                            <div class="user-name">
                                {{user.name}}
                            </div>
                        </div>

                        <div class="quickpost-date">
                            {{ prettyDate(quickpost.created_at) }}
                        </div>
                    </div>

                    <div class="quickpost-body">
                        {{ quickpost.text }}
                    </div>

                    <div v-if="quickpost.file" class="quickpost-img" :id="quickpost.id + 1">
                        <img @click="showModal(), openPost(quickpost)" :src="url + '/storage/quickposts-images/' + quickpost.file" alt="#" class="img-fluid">
                    </div>
                </div>
            </transition-group>
        </div>

        <b-modal id="modal-sm" v-if="this.openedPost">
            <template>
                <div class="user-info">
                    <a :href="`/users/${this.openedPost.user.id}`" class="profile-link header-link" ref="profile-link" v-if="this.openedPost.user.image">
                        <b-avatar class="user-avatar" :src="url + '/storage/users-images/' + this.openedPost.user.image"></b-avatar>
                    </a>

                    <a :href="`/users/${this.openedPost.user.id}`" class="profile-link header-link" ref="profile-link" v-if="!this.openedPost.user.image">
                        <b-avatar class="user-avatar" variant="primary" :text="getInitials(this.openedPost.user.name)"></b-avatar>
                    </a>

                    <div class="user-name">
                        {{ this.openedPost.user.name }}
                    </div>
                </div>
            </template>

            <template>
                <img :src="url + '/storage/quickposts-images/' + this.openedPost.file" alt="#" class="img-fluid" ref="fullImage">
            </template>

            <template #modal-footer="{cancel}">
                <b-button @click="cancel()" pill>
                    Cancel
                </b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
    import VueMixins from '../mixins/VueMixins'
    import QuickPostForm from './QuickPostForm'

    export default {
        mixins: [VueMixins],
        props: ['user', 'quickp', 'url'],
        components: {
            QuickPostForm
        },
        data() {
            return {
                quickposts: [],
                full: false,
                openedPost: '',
            }
        },

        mounted () {
            this.quickposts = this.quickp

            this.quickposts.sort(function(a, b) {
                a = new Date(a.created_at);
                b = new Date(b.created_at);
                var results = a > b ? -1 : a < b ? 1 : 0;
                return results
            });

            this.$root.$on('delete-img', quickpost => {
                let quickpostImg = document.getElementById(`${quickpost.id + 1}`)
                quickpostImg.parentNode.removeChild(quickpostImg)
            })

            this.$root.$on('new-quickpost', quickpost => {
                this.quickposts.unshift(quickpost)
            })
        },

        methods: {
            
        },
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
        transform: scale(1);
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: scale(0);
    }

    #modal-1 {
        max-width: 90vh;
    }
</style>