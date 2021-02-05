<template>
    <div class="single-quickpost">
        <form>

            <b-form-file
            @change="setFile"
            ref="imgFile"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
            ></b-form-file>

            <b-form-textarea
                id="textarea-no-resize"
                placeholder="Type something"
                :state="textState"
                v-model="text"
            ></b-form-textarea>

        </form>

        <div class="new-post-controls">
            <b-button class="my-buttons post-submit" @click="submitForm" variant="success">Submit</b-button>
            <b-button class="my-buttons post-cancel" @click="$router.go(-1)" variant="outline-primary">Cancel</b-button>
        </div>
    </div>
</template>

<script>
    import tableMixin from '../../mixins/tableMixin'

    export default {
        mixins: [tableMixin],
        props: ['errors', 'quickpost', 'meta'],
        data(){
            return {
                text: '',
                oldImg: '',
                imgFile: '',
                quickpost_id: '',
                user: null,
            }
        },

        mounted() {
            this.returnUser()
        },

        methods: {
            submitForm() {
                let data = {
                    text: this.text,
                    image: this.imgFile,
                    user_id: this.user.id
                }

                if(this.meta == 'new'){
                    this.$emit('quickpost-form-submitted', data)
                } else if (this.meta == 'edit'){
                    data['old_img'] = this.oldImg
                    data['id'] = this.quickpost_id
                    this.$emit('quickpost-form-submitted', data)
                }
            },

            setFile(e){
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload = (e) => {
                    this.imgFile = e.target.result
                }
            },
        },

        computed: {
            textState() {
                if(this.errors.text){
                    return false
                }
            },
        },

         watch: {
            quickpost(quickpost){
                this.quickpost_id = quickpost.id,
                this.text = quickpost.text,
                this.oldImg = quickpost.image
            },
        },
    }
</script>

<style lang="scss" scoped>
    .single-quickpost {
        background: #262525;
        border-radius: 2em;
        width: 50%;
        margin: 1em auto;

        @media (max-width: 500px){
            width: 100%;
            padding: 1em;
            .new-post-controls {
                display: flex;
                justify-content: space-evenly;
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

        textarea {
            border-radius: 1em !important;
        }

        .new-post-controls {
            padding: 1em;
            .new-post-btn {
                border-radius: .7em;
            }
        }
    }
</style>