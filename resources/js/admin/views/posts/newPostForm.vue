<template>
    <div class="single-post">
        <form>
            <div class="form-group">
                <label for="title-input">Title</label>
                <b-form-input
                id="input-live"
                v-model="title"
                :state="titleState"
                aria-describedby="input-live-feedback"
                placeholder="Title"
                trim
                class="new-post-input"
                ></b-form-input>
                <b-form-invalid-feedback id="input-live-feedback">
                    <div v-for="error in errors.title" :key="error.index">
                        {{ error }}
                    </div>
                </b-form-invalid-feedback>
            </div>
            <div class="form-group">
                <label for="slug-input">Slug</label>
                <b-form-input
                id="input-live"
                v-model="slug"
                :state="slugState"
                aria-describedby="input-live-feedback"
                placeholder="Slug"
                trim
                class="new-post-input"
                ></b-form-input>
                <b-form-invalid-feedback id="input-live-feedback">
                    <div v-for="error in errors.slug" :key="error.index">
                        {{ error }}
                    </div>
                </b-form-invalid-feedback>
            </div>

            <div class="tags-form">
                <label for="tag-input">Tags</label>
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

            <b-form-file
            @change="setFile"
            ref="imgFile"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
            ></b-form-file>

            <div class="form-group">
                <input 
                    id="x" 
                    :value="text" 
                    type="hidden" 
                    name="text"
                >
                <trix-editor input="x" class="my-3 new-post-input"></trix-editor>
            </div>
        </form>

        <div class="new-post-controls">
            <b-button class="my-buttons post-submit" @click="submitForm" variant="success">Submit</b-button>
            <b-button class="my-buttons post-cancel" @click="$router.go(-1)" variant="outline-primary">Cancel</b-button>
        </div>
    </div>
</template>

<script>
    import trix from 'trix'
    import tableMixin from '../../mixins/tableMixin'

    export default {
        mixins: [tableMixin],
        props: ['errors', 'post', 'meta'],
        data(){
            return {
                title: '',
                slug: '',
                text: '',
                oldImg: '',
                imgFile: '',
                post_id: '',
                user: null,

                tags: [],
                detached: [],
                tag: '',
            }
        },

        mounted() {
            this.returnUser()
            document.addEventListener('trix-change', () => {
                this.text = document.getElementById('x').value
            })
        },

        computed: {
            titleState() {
                if(this.errors.title){
                    return false
                }
            },

            slugState() {
                if(this.errors.slug){
                    return false
                }
            },
        },

        methods: {
            submitForm() {
                let data = {
                    title: this.title,
                    slug: this.slug,
                    text: this.text,
                    tags: this.tags,
                    file: this.imgFile,
                    user_id: this.user.id
                }

                if(this.meta == 'new'){
                    this.$emit('post-form-submitted', data)
                } else if (this.meta == 'edit'){
                    data['old_img'] = this.oldImg
                    data['detached'] = this.detached
                    data['id'] = this.post_id
                    this.$emit('post-form-submitted', data)
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

            setFile(e){
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload = (e) => {
                    this.imgFile = e.target.result
                }
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

            post(post){
                this.title = post.title,
                this.slug = post.slug,
                this.post_id = post.id,
                this.oldImg = post.image,
                this.tags = post.tags

                let element = document.querySelector("trix-editor")
                element.editor.insertHTML(post.text)
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import '~trix/dist/trix.css';
    trix-editor {
        height: 20em;
        color: #fff;
    }

    .single-post {
        background: #262525;
        border-radius: 2em;
        width: 80%;
        margin: 1em auto;

        @media (max-width: 500px){
            width: 100%;
            padding: 1em;
            .new-post-controls {
                display: flex;
                justify-content: space-evenly;
            }
        }

        .tags-form {
            .form {
                display: flex;
                flex-wrap: wrap;
                margin: 1em auto;
                margin-top: 0;
                align-items: center;
                grid-gap: 1em;

                .form-control {
                    border-radius: 1em;
                }
            }

            .tags {
                margin: 1em auto;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                grid-gap: 0.5em;
            }
        }

        .b-form-file {
            margin: 1em auto;
            label {
                border-radius: 1em !important;
            }
        }

        form {
             padding: 2em;
        }

        .new-post-input {
            border-radius: 1em !important;
            overflow: auto;
        }

        img {
            margin: 1em auto;
            display: block;
            border-radius: 1em;
        }

        .new-post-controls {
            padding: 1em;
            .new-post-btn {
                border-radius: .7em;
            }
        }
    }
</style>