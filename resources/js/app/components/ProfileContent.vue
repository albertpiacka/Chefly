<template>
    <div>
        <b-tabs v-model="tabIndex" small card>
            <b-tab title="Posts">
                <div class="posts">
                    <b-button v-b-toggle.collapse-1 variant="primary" pill>My articles</b-button>
                    <b-collapse id="collapse-1" class="mt-2">
                        <div v-for="post in this.posts" :key="post.id" class="post">
                            <div class="post-title">
                                <a :href="'/posts/' + post.slug">{{ post.title }}</a>
                            </div>
                            <div class="btn-wrapper">
                                <b-button variant="outline-primary" @click="editPost(post)">Edit</b-button>
                                <b-button variant="danger" @click="deletePost(post)">Delete</b-button>
                            </div>
                        </div>
                    </b-collapse>
                </div>
            </b-tab>

            <b-tab title="Followers">
                <div class="followers">
                    <b-button v-b-toggle.collapse-2 variant="primary" pill>My followers</b-button>
                    <b-collapse id="collapse-2" class="mt-2">
                        <div v-for="follower in this.followers" :key="follower.id" class="follower">
                            <div class="left-wrapper">
                                <div :id="`follower-popover-${follower.follower.id}`">
                                    <a :href="`/users/${follower.follower.id}`" class="profile-link header-link" ref="profile-link" v-if="follower.follower.image">
                                        <b-avatar class="user-avatar" :src="url + '/storage/users-images/' + follower.follower.image"></b-avatar>
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

                            <div class="right-wrapper">
                                <b-button variant="outline-primary" v-show="!follower.following" 
                                    @click="addFollow(follower)"
                                    :id="`followBtn${follower.id}`"
                                >
                                    Follow
                                </b-button>

                                <b-button variant="danger" @click="removeFollower(follower)">Remove</b-button>
                            </div>
                        </div>
                    </b-collapse>
                </div>
            </b-tab>

            <b-tab title="Images">
                <div class="gallery">
                    <div v-for="quickpost in filteredImages" :key="quickpost.id">
                        <div class="img" :id="quickpost.id">
                            <b-img thumbnail fluid :src="url + '/storage/quickposts-images/' + quickpost.file" alt="#"></b-img>
                            <b-icon icon="x-circle" @click="deleteImg(quickpost)"></b-icon>
                        </div>
                    </div>
                </div>
            </b-tab>

            <b-tab title="Settings">
                <div class="settings">
                    <h4>Who can see my content?</h4>
                    <b-form-select v-model="selected" :options="options" @change="setPermission"></b-form-select>
                </div>
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
    export default {
        props: ['user', 'quickPosts', 'url', 'usersFollowing'],
        data() {
            return {
                tabIndex: 0,
                quickposts: [],
                followers: [],
                posts: [],
                following: [],

                selected: null,
                options: [
                    { value: null, text: 'Please select an option' },
                    { value: 'a', text: 'Everyone' },
                    { value: 'b', text: 'My followers' },
                    { value: 'c', text: 'Only people I follow' },
                    { value: 'd', text: 'Just me' },
                ],
            }
        },

        mounted () {
            this.quickposts = this.quickPosts
            this.followers = this.user.followers
            this.posts = this.user.posts
            this.following = this.usersFollowing
            this.selected = this.user.permision

            this.followers.forEach(follower => {
                this.following.forEach(following => {
                    if(follower.follower_id == following.user_id){
                        follower['following'] = true
                    } else {
                        follower['following'] = false
                    }
                })
            })

            this.$root.$on('new-quickpost', quickpost => {
                this.quickposts.unshift(quickpost)
            })

            this.$root.$on('new-post', post => {
                this.posts.push(post)
            })

            this.$root.$on('edited-post', post => {
                this.posts = this.posts.filter(p => p.id !== post.id)
                this.posts.unshift(post)
            })
        },

        methods: {
            editPost(post){
                this.$root.$emit('edit-post', post)
            },

            deletePost(post){
                axios.delete(`/api/posts/${post.slug}`)
                     .then(response => {
                         this.posts = this.posts.filter(val => val.id !== post.id)
                         this.$root.$emit('flash', response.data.message)
                     })
            },  

            deleteImg(quickpost) {
                this.quickposts = this.quickPosts.filter(item => item.id !== quickpost.id)

                this.$root.$emit('delete-img', quickpost)
                
                axios.put(`/quickposts/${quickpost.id}`, quickpost)
            },

            getInitials(name) {
                return name.charAt(0).toUpperCase()
            },

            removeFollower(follower){
                this.followers = this.followers.filter(val => val.id !== follower.id)

                axios.delete(`/follows/${follower.id}`)
                     .then(response => {
                         this.$root.$emit('flash', response.data.message)
                     })
            },

            addFollow(follower){
                follower['following'] = true
                let followBtn = document.getElementById(`followBtn${follower.id}`)
                setTimeout(() => {
                    followBtn.parentNode.removeChild(followBtn)
                }, 500);

                axios.post('/follows', {
                        user_id: follower.follower_id, 
                        follower_id: this.user.id
                     })
                     .then(response => {
                         this.$root.$emit('flash', response.data.message)
                     })
            },

            setPermission(){
                let data = {
                    permision: this.selected,
                }

                axios.patch(`/users/${this.user.id}`, data)
                     .then(response => {
                         this.$root.$emit('flash', 'Changes saved')
                     })
                     .catch(response => {
                         this.$root.$emit('flash', 'Something went wrond :-/ , try again')
                     })
            }
        },

        computed: {
            filteredImages() {
                return this.quickposts.filter(item => item.file !== null)
            }
        },
    }
</script>

<style lang="scss" scoped>
    .btn-danger {
        border-radius: 1em !important;
    }

    .btn-outline-primary {
        border-radius: 1em !important;
    }

    .posts {
        .post {
            margin: 1em 0;
            display: grid;
            grid-gap: .2em;
            grid-template-columns: 1fr 1fr;
            .post-title {
                margin: 1em 0;
            }

            .btn-wrapper {
                align-self: center;
            }
        }
    }
</style>