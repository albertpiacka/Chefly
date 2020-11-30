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

    export default {
        props: ['errors', 'post'],
        data(){
            return {
                title: '',
                slug: '',
                text: '',
                post_id: ''
            }
        },

        mounted() {
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
                    id: this.post_id,
                    user_id: userId
                }

                this.$emit('post-form-submitted', data)
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
                this.post_id = post.id

                let element = document.querySelector("trix-editor")
                element.editor.insertHTML(post.text)
            }
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
        padding: 2em;
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

        .new-post-input {
            border-radius: 1em;
            overflow: auto;
        }

        .new-post-controls {
            .new-post-btn {
                border-radius: .7em;
            }
        }
    }
</style>