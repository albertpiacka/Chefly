

<script>
    export default {
        props: ['post-data'],
        data() {
            return {
                comments: [

                ]
            }
        },

        created () {
            this.printComment()
            this.$root.$on('comment', message => {
                this.comments.push(message)
            })
        },

        methods: {
            printComment() {
                this.comments = this.postData.comments
            },

            prettyDate(date){
                return momentJs(date).fromNow()
            }
        },
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    [contenteditable='true'] {
        border: 1px solid var(--color-article);
        outline: none;
    }
</style>