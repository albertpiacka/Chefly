<template>
    <div class="following-posts">
        <div 
        v-for="post in this.filtered" 
        :key="post.id" class="following-post" 
        :class="{withImage: post.image}"
        data-aos="fade-up"
        data-aos-delay="100"
        > 
            <div class="img-box">
                <img :src="baseUrl + '/storage/posts-images/' + post.image" alt="#" class="img-fluid" v-if="post.image">
            </div>
            
            <div class="content-box">
                <div class="content-header">
                    <div class="author-avatar" :id="`follower-popover-${post.user.id}`">
                        <a :href="'/users/' + post.user.id" class="profile-link header-link" ref="profile-link" v-if="post.user.image">
                            <b-avatar class="user-avatar" :src="baseUrl + '/storage/users-images/' + post.user.image"></b-avatar>
                        </a>

                        <a :href="'/users/' + post.user.id" class="profile-link header-link" ref="profile-link" v-if="!post.user.image">
                            <b-avatar class="user-avatar" variant="warning" :text="getInitials(post)"></b-avatar>
                        </a>
                    </div>

                    <b-popover :target="`follower-popover-${post.user.id}`" title="" triggers="hover" v-if="post.user.id !== user.id">
                        <a :href="`/users/${post.user.id}`">{{ post.user.name }}</a>
                        <p>
                            {{post.user.about}}
                        </p>
                    </b-popover>

                    <div class="user-name">
                        {{post.user.name}} 
                    </div>

                    <div v-if="post.likes" class="post-likes">
                        <div>{{post.likes.length}}</div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </div>
                </div>

                <div class="content-body">
                    <div class="title">
                        <a :href="'/posts/' + post.slug">{{post.title}} </a>
                    </div>
                    <div class="text"
                        v-html="truncate(post.text)"
                    >
                    </div>
                </div>

                <div class="quickpost-content">
                    <div class="img-box">
                        <img :src="baseUrl + '/storage/quickposts-images/' + post.file" alt="#" class="img-fluid" v-if="post.file">
                    </div>
                </div>

                <div class="content-footer">
                    <div>
                        {{prettyDate(post.created_at)}} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'following', 'base-url', 'myPosts', 'myQuickposts'],
        data() {
            return {
                initials: '',
                poll: [],
                filtered: [],
            }
        },

        mounted () {
            this.following.forEach(follower => {
                follower.user.posts.forEach(post => {
                    this.poll.push(post)
                })

                follower.user.quickposts.forEach(post => {
                    this.poll.push(post)
                })
            })

            this.myPosts.forEach(post => {
                this.poll.push(post)
            })

            this.myQuickposts.forEach(post => {
                this.poll.push(post)
            })

            this.poll.forEach(val => {
                if(val.created_at >= momentJs(new Date(new Date().setDate(new Date().getDate()-5))).format()){
                    this.filtered.unshift(val)
                }
            })

            this.filtered.sort(function(a, b) {
                a = new Date(a.created_at);
                b = new Date(b.created_at);
                var results = a > b ? -1 : a < b ? 1 : 0;
                return results
            });

            this.$root.$on('new-quickpost', quickpost => {
                this.filtered.unshift(quickpost)
            })
        },

        methods: {
            prettyDate(date){
                return momentJs(date).fromNow()
            },

            getInitials(post) {
                return post.user.name.charAt(0).toUpperCase()
            },

            truncate(text){
                return _.truncate( 
                    text, { 
                        'length': 50, 
                    } 
                )
            }
        },
    }
</script>

<style lang="scss" scoped>
    
</style>