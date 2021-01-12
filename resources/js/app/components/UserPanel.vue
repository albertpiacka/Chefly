<template>
    <div class="panel-wrapper">
        <div class="user-panel">
            <svg @click="toggleBookmarked"
                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
            </svg>

            <svg @click="togglePost"
                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </div>
        
        <transition name="fade">
            <div class="panel-content panel-bookmarked" v-show="bookmarked">
                <transition-group name="fade">
                    <div v-for="bookmark in bookmarks" :key="bookmark.id" class="bookmark-post">
                        <a :href="'/posts/' + bookmark.post.slug">
                            <div class="post-img" v-if="bookmark.post.image">
                                <img :src="baseUrl + '/' + bookmark.post.image" class="img-fluid" alt="#">
                            </div>
                            <div class="post-title">
                                {{ bookmark.post.title }}
                            </div>
                        </a>
                    </div>
                </transition-group>
            </div>
        </transition>

        <transition name="fade">
            <div class="panel-content panel-newPost" v-show="newPost">
                <div class="form-group">
                    <b-form-input
                    v-model="title"
                    aria-describedby="input-live-feedback"
                    placeholder="Title"
                    trim
                    class="new-post-input"
                    ></b-form-input>
                </div>

                <div class="form-group">
                    <b-form-input
                    v-model="slug"
                    aria-describedby="input-live-feedback"
                    placeholder="Slug"
                    trim
                    class="new-post-input"
                    ></b-form-input>
                </div>

                <input name="file" type="file"
                    ref="imgFile"
                >

                <b-form-tags
                input-id="tags-pills"
                v-model="tags"
                tag-variant="primary"
                tag-pills
                size="lg"
                separator=" "
                ></b-form-tags>
                <input 
                    id="x" 
                    :value="text" 
                    type="hidden" 
                    name="text"
                >
                <trix-editor input="x" class="my-3 new-post-input"
                    ref="postText"
                    @input="returnText"
                ></trix-editor>
            </div>
        </transition>
    </div>
</template>

<script>
    import trix from 'trix'

    export default {
       props: ['userData', 'baseUrl'],
       data() {
           return {
            bookmarked: false,
            newPost: false,
            bookmarks: this.userData.bookmarks,
            tags: ['burgers', 'pizza', 'pasta'],
            title: '',
            slug: '',
            text: '',
            imgFile: '',
            post_id: '',
            user: null,
           }
       },

       mounted () {
           this.user = this.userData
           this.$root.$on('bookmark-delete', data => {
                this.bookmarks = this.bookmarks.filter(n => n.id != data[0].id)
           })

           this.$root.$on('bookmark-create', data => {
                this.bookmarks.unshift(data)
           })
       },

        methods: {
           toggleBookmarked() {
               if(this.bookmarked == false){
                   this.bookmarked = true
                   this.newPost = false
               } else if(this.bookmarked == true){
                   this.bookmarked = false
               }
           },

           togglePost() {
               let main = document.querySelector('main')
               if(this.newPost == false){
                   this.newPost = true
                   this.bookmarked = false
                   main.classList.add('blurred')
               } else if(this.newPost == true){
                   this.newPost = false
                   main.classList.remove('blurred')
               }
           },

           returnText(){
               console.log(this.$refs.postText.value)
           }
       },

       watch: {
            title(value) {
                this.slug = 
                        _.trim(
                        _.deburr(value.toLowerCase()) // diacritics
                            .replace(/[^\w\s]/gi, '') // special characters
                            .replace(/ {2,}/g, ' ') // repeating spaces
                            .replace(/ /g, '-'), // space to -
                        '-' // trailing -
                    )
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import '~trix/dist/trix.css';
    
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
        transform: scale(1);
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: scale(0);
    }

    ::-webkit-scrollbar {
        width: 0px;  
        background: transparent;  
    }

    .bi {
        cursor: pointer;
    }

    .bookmark-post {
        width: 100%;
        min-height: 5em;
        overflow: hidden;
        border-radius: 2em;
        background: #aaa;
        position: relative;
        margin: 1em auto;
        .post-img {
            width: 100%;
            height: 100%;
            img {
                border-radius: 2em;
            }
        }
        .post-title {
            position: absolute;
            top: 1em;
            left: .3em;
            color: #fff;
        }
    }
</style>