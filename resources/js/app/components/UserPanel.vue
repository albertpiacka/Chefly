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
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-x-circle my-2 float-right" viewBox="0 0 16 16"
                @click="toggleBookmarked"
                >
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                <transition-group name="fade">
                    <div v-for="bookmark in bookmarks" :key="bookmark.id" class="bookmark-post">
                        <a :href="'/posts/' + bookmark.post.slug">
                            <div class="post-img" v-if="bookmark.post.image">
                                <img :src="baseUrl + '/posts-images/' + bookmark.post.image" class="img-fluid" alt="#">
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
            <div class="panel-content panel-newPost" v-show="newPost || editPost">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-x-circle my-2" viewBox="0 0 16 16"
                @click="togglePost"
                >
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>

                <section>
                    <div class="wrapper">
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
                    </div>

                    <b-form-file
                    @change="setFile"
                    placeholder="Choose a file or drop it here..."
                    drop-placeholder="Drop file here..."
                    ></b-form-file>
                </section>

                <div class="tags-form">
                    <div class="form">
                        <b-form-input id="input-default" placeholder="New tag" @keydown.enter="addTag" v-model="tag"></b-form-input>
                        <b-button pill @click="addTag">Add tag</b-button>
                    </div>

                    <div class="tags">
                        <div v-for="tag in this.tags" :key="tag.id">
                            <b-button pill variant="primary">
                                {{ tag.tag }}
                                <span @click="removeTag(tag)"><b-icon icon="x-circle"></b-icon></span>
                            </b-button>
                        </div>
                    </div>
                </div>

                <input 
                    id="x" 
                    :value="text" 
                    type="hidden" 
                    name="text"
                >
                <trix-editor input="x" class="my-3 new-post-input"
                    ref="postText"
                ></trix-editor>

                <b-button variant="primary" @click="submitForm">Publish</b-button>
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
            editPost: false,
            bookmarks: this.userData.bookmarks,

            tags: [],
            detached: [],
            tag: '',

            title: '',
            slug: '',
            text: '',
            oldImg: '',
            imgFile: '',
            post_id: '',
            post: '',

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

           this.$root.$on('edit-post', post => {
               this.post = post

               let element = document.querySelector("trix-editor")
               element.editor.insertHTML(post.text)
               
               this.editPost = true
           })

           document.addEventListener('trix-change', () => {
                this.text = document.getElementById('x').value
           })
       },

        methods: {
           toggleBookmarked() {
               let main = document.querySelector('main')
               if(this.bookmarked == false){
                   this.bookmarked = true
                   this.newPost = false
                   main.classList.remove('blurred')
               } else if(this.bookmarked == true){
                   this.bookmarked = false
                   main.classList.remove('blurred')
               }
           },

           togglePost() {
               let main = document.querySelector('main')
               if(this.editPost == true){
                   this.editPost = false
                   this.post = ''

                   let element = document.querySelector("trix-editor")
                   element.innerText = ''

                   main.classList.remove('blurred')
               } else if(this.newPost == false){
                   this.newPost = true
                   this.bookmarked = false
                   this.tags = []
                   main.classList.add('blurred')
               } else if(this.newPost == true){
                   this.newPost = false
                   this.editPost = false
                   main.classList.remove('blurred')
               }
           },

           setFile(e){
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload = (e) => {
                    this.imgFile = e.target.result
                }
            },

            addTag(){
                if(this.tag !== ''){
                    let tag = {
                        id: null,
                        tag: this.tag,
                    }

                    this.tags.push(tag)

                    this.tag = ''
                }
            },

            removeTag(tag){
                this.tags = this.tags.filter(val => val.tag !== tag.tag)
                if(tag.id !== null){
                    this.detached.push(tag)
                }
            },

            submitForm() {
                let main = document.querySelector('main')

                let data = {
                    title: this.title,
                    slug: this.slug,
                    tags: this.tags,
                    text: this.text,
                    file: this.imgFile,
                    user_id: this.user.id
                }
                
                if(this.newPost){
                    axios.post('/api/posts', data)
                     .then(response => {
                        this.$root.$emit('flash', response.data.message)
                        this.$root.$emit('new-post', response.data.post)
                        this.post = ''
                        this.newPost = false
                        main.classList.remove('blurred')
                     })
                } else if(this.editPost){
                    data['old_img'] = this.oldImg
                    data['detached'] = this.detached
                    
                    axios.patch(`/api/posts/${this.post_id}`, data)
                         .then(response => {
                            this.$root.$emit('flash', response.data.message)
                            this.$root.$emit('edited-post', response.data.post)
                         })
                }
            },
       },

       watch: {
            title(value) {
                if(this.title){
                    this.slug = 
                        _.trim(
                        _.deburr(value.toLowerCase()) // diacritics
                            .replace(/[^\w\s]/gi, '') // special characters
                            .replace(/ {2,}/g, ' ') // repeating spaces
                            .replace(/ /g, '-'), // space to -
                        '-' // trailing -
                    )
                }
            },

            post(post){
                this.title = post.title
                this.slug = post.slug
                this.text = post.text
                this.oldImg = post.image
                this.post_id = post.id
                this.tags = post.tags
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

    section {
        display: grid;
        grid-gap: 1em;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        @media (min-width: 768px) {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
</style>