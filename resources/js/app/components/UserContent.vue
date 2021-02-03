<template>
    <div>
        <div v-if="this.canView">
            <b-tabs v-model="tabIndex" small card>
                <b-tab title="Posts">
                    <div class="posts">
                        <div v-for="post in this.posts" :key="post.id" class="post">
                            <div class="post-date">
                                {{ prettyDate(post.created_at) }} |
                            </div>
                            <div class="post-title">
                                <a :href="`/posts/${post.title}`">{{ post.title }}</a>
                            </div>
                        </div>
                    </div>
                </b-tab>

                <b-tab title="Followers">
                    <div class="followers">
                        <div v-for="follower in this.followers" :key="follower.id" class="follower">
                            <div class="left-wrapper">
                                <div :id="`follower-popover-${follower.follower.id}`">
                                    <a :href="`/users/${follower.follower.id}`" class="profile-link header-link" ref="profile-link" v-if="follower.follower.image">
                                        <b-avatar class="user-avatar" :src="url + '/users-images/' + follower.follower.image"></b-avatar>
                                    </a>

                                    <a :href="`/users/${follower.follower.id}`" class="profile-link header-link" ref="profile-link" v-if="!follower.follower.image">
                                        <b-avatar class="user-avatar" variant="primary" :text="getInitials(follower.follower.name)"></b-avatar>
                                    </a>
                                </div>

                                <b-popover :target="`follower-popover-${follower.follower.id}`" title="" triggers="hover">
                                    <a :href="`/users/${follower.follower.id}`">{{ follower.follower.name }}</a>
                                    <p>
                                        {{follower.follower.about}}
                                    </p>
                                </b-popover>
                            </div>
                        </div>
                    </div>
                </b-tab>

                <b-tab title="Images">
                    <div class="gallery">
                        <div v-for="quickpost in filteredImages" :key="quickpost.id">
                            <div class="img" :id="quickpost.id">
                                <b-img 
                                    @click="showModal(), openPost(quickpost)"
                                    thumbnail fluid :src="url + '/' + quickpost.file" alt="#"
                                ></b-img>
                            </div>
                        </div>
                    </div>
                </b-tab>
            </b-tabs>

            <div class="quickpost">
                <transition-group name="fade">
                    <div v-if="this.quickposts.length > 0" key="quickpost">
                        <div v-for="quickpost in this.quickposts" :key="quickpost.id" class="quick-post">
                            <div class="quickpost-header">
                                <div>
                                    <user-avatar
                                    :user="quickpost.user" 
                                    :base-url="url"
                                    ></user-avatar>

                                    <div class="user-name">
                                        {{quickpost.user.name}}
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
                                <img @click="showModal(), openPost(quickpost)" :src="url + '/quickposts-images/' + quickpost.file" alt="#" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </transition-group>

                <div v-if="this.quickposts.length == 0">
                    No posts yet
                </div>
            </div>

            <b-modal id="modal-sm" v-if="this.openedPost">
                <template>
                    <div class="user-info">
                        <a :href="`/users/${this.openedPost.user.id}`" class="profile-link header-link" ref="profile-link" v-if="this.openedPost.user.image">
                            <b-avatar class="user-avatar" :src="url + '/users-images/' + this.openedPost.user.image"></b-avatar>
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
                    <b-skeleton-img v-show="!isLoaded"></b-skeleton-img>
                    <img :src="`${url}/quickposts-images/${this.openedPost.file}`" alt="#" class="img-fluid" ref="fullImage" @load="onImgLoad" v-show="isLoaded">
                </template>

                <template #modal-footer="{cancel}">
                    <b-button @click="cancel()" pill>
                        Cancel
                    </b-button>
                </template>
            </b-modal>
        </div>
    </div>
</template>

<script>
    import VueMixins from '../mixins/VueMixins'

    export default {
        mixins: [VueMixins],
        props: ['userData', 'authData', 'userPosts', 'usersFollowing', 'url'],
        data() {
            return {
                tabIndex: 1,
                user: null,
                auth: null,
                following: null,
                quickposts: null,
                canView: false,

                openedPost: '',
                isLoaded: false,

                posts: null,
                followers: null,
            }
        },

        mounted() {
            this.user = this.userData
            this.auth = this.authData
            this.following = this.usersFollowing
            this.quickposts = this.userPosts

            this.posts = this.userData.posts
            this.followers = this.userData.followers

            if(this.userData.permision == 'a'){
                this.canView = true
            } else if(this.userData.permision == 'b'){
                this.user.followers.forEach(follower => {
                    if(follower.follower_id == this.auth.id){
                        this.canView = true
                    } else this.canView = false
                })
            } else if(this.userData.permision == 'c'){
                this.following.forEach(following => {
                    if(following.user_id == this.auth.id){
                        this.canView = true
                    } else this.canView = false
                })
            } else if(this.userData.permision == 'd'){
                this.canView = false
            }
        },

        methods: {
            onImgLoad () {
                this.isLoaded = true
                let skeleton = document.querySelector('.b-aspect')
                skeleton.parentNode.removeChild(skeleton)
            }
        },

        computed: {
            filteredImages() {
                return this.quickposts.filter(item => item.file !== null)
            },
        },
    }
</script>

<style lang="scss" scoped>
  .posts {
      .post {
          display: flex;
          grid-gap: 1em;
          padding: 1em;
      }
  }
</style>