<template>
    <div class="single-comment" data-aos="fade-up">
        <h2 class="py-2">Comment</h2>

        <article class="paragraph">
            <textarea rows="5" v-model="comment.text"></textarea>
        </article>

        <div class="comment-info">
            <div class="info-item">
                <small>Comment id</small>
                | {{comment.id}}
            </div>
            <div class="info-item">
                <small>Author</small>
                | {{comment.user.name}}
            </div>
            <div class="info-item">
                <small>Commented</small>
                | {{prettyDate(comment.createdAt)}}
            </div>
            <div class="info-item">
                <small>Updated</small>
                | {{exactDate(comment.updated_at)}}
            </div>
        </div>

        <div class="edit-comment-controls">
            <b-button class="my-buttons post-submit" @click="editComment" variant="success">Submit</b-button>
            <b-button class="my-buttons post-cancel" @click="$router.go(-1)" variant="outline-primary">Cancel</b-button>
        </div>
    </div>
</template>

<script>
    import tableMixin from '../../mixins/tableMixin'
    import SingleLinkControls from '../../components/SingleLinkControls'

    export default {
        mixins: [tableMixin],
        components: {
            SingleLinkControls,
        },
        data() {
            return {
                comment: {

                }
            }
        },

        mounted () {
            axios.get('/api/comments/' + this.$route.params.id)
                 .then(response => {
                    this.comment = response.data
                 })
                 .catch(err => {
                    return this.$router.push('/admin/404')
                 })
        },

        methods: {
            editComment() {
                axios.patch(`/api/comments/${this.comment.id}`, this.comment)
                     .then(response => {
                         this.$router.push(`/admin/comments/${this.comment.id}`)
                     })   
            }
        },
    }
</script>

<style lang="scss" scoped>
   .single-comment {
        background: #262525;
        padding: 2em;
        border-radius: 2em;
        width: 80%;
        margin: auto;


        .paragraph {
            margin: 1em 0;
            textarea {
                width: 100%;
                border-radius: 1em;
            }
        }

        .comment-info {
            padding: 1.5em 0;
            .info-item {
                margin: .3em 0;
            }
        }

        @media (max-width: 500px){
            width: 100%;
        }
    }
</style>