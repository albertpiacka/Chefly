<template>
    <div class="single-quickpost">

            <h2 class="py-2">{{quickpost.title}}</h2>

            <article class="paragraph">
                <div
                    v-html="quickpost.text"
                >
                </div>
            </article>

            <div class="quickpost-info">
                <div class="info-item">
                    <small>quickpost id</small>
                    | {{quickpost.id}}
                </div>
                <div class="info-item">
                    <small>Author</small>
                    | {{quickpost.user.name}}
                </div>
                <div class="info-item">
                    <small>quickposted</small>
                    | {{prettyDate(quickpost.createdAt)}}
                </div>
                <div class="info-item">
                    <small>Updated</small>
                    | {{exactDate(quickpost.updated_at)}}
                </div>
                <div class="info-item">
                    <input ref="id" type="text" :value="quickpost.id" class="id-input">
                    <button @click="makeToast('success', 'Copied')" class="copy-button my-buttons">Copy</button>
                </div>
            </div>

            <single-link-controls resource="quickpost" :id="quickpost.id"/>

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
                quickpost: {

                }
            }
        },

        mounted () {
            axios.get('/api/quickposts/' + this.$route.params.id)
                 .then(response => {
                    this.quickpost = response.data
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

                this.$refs.id.select()
                document.execCommand("copy")
            }
        },
    }
</script>

<style lang="scss" scoped>
    .single-quickpost {
        background: #262525;
        padding: 2em;
        border-radius: 2em;
        width: 80%;
        margin: auto;


        .paragraph {
            margin: 1em 0;
        }

        .quickpost-info {
            padding: 1.5em 0;
            .info-item {
                margin: .3em 0;
            }
        }

        .id-input {
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