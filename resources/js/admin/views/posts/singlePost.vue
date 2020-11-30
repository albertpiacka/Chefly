<template>
    <div class="single-post">

            <h2 class="py-2">{{post.title}}</h2>

            <article class="paragraph">
                <div
                    v-html="post.text"
                >
                </div>
            </article>

            <div class="post-info">
                <div class="info-item">
                    <small>Post id</small>
                    | {{post.id}}
                </div>
                <div class="info-item">
                    <small>Author</small>
                    | {{post.user.name}}
                </div>
                <div class="info-item">
                    <small>Posted</small>
                    | {{prettyDate(post.createdAt)}}
                </div>
                <div class="info-item">
                    <small>Updated</small>
                    | {{exactDate(post.updated_at)}}
                </div>
                <div class="info-item">
                    <input ref="slug" type="text" :value="post.slug" class="slug-input">
                    <button @click="makeToast('success', 'Copied')" class="copy-button my-buttons">Copy</button>
                </div>
            </div>

            <single-link-controls resource="post" :id="post.slug"/>

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
                post: {

                }
            }
        },

        mounted () {
            axios.get('/api/posts/' + this.$route.params.slug)
                 .then(response => {
                    this.post = response.data
                 })
                 .catch(err => {
                    return this.$router.push('/admin/404')
                 })
        },

        methods: {
            makeToast(variant = null, text) {
                this.$bvToast.toast(`${text}`, {
                    title: `${variant}`,
                    variant: variant,
                    solid: true
                })

                this.$refs.slug.select()
                document.execCommand("copy")
            }
        },
    }
</script>

<style lang="scss" scoped>
    .single-post {
        background: #262525;
        padding: 2em;
        border-radius: 2em;
        width: 80%;
        margin: auto;


        .paragraph {
            margin: 1em 0;
        }

        .post-info {
            padding: 1.5em 0;
            .info-item {
                margin: .3em 0;
            }
        }

        .slug-input {
            padding: .3em;
            outline: none;
            border: none;
            background: #fff;
            color: #000;
            border-radius: 1em;
        }

        @media (max-width: 500px){
            width: 100%;
        }
    }
</style>