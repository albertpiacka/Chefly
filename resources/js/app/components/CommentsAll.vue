

<script>
    export default {
        props: ['post-data'],
        data() {
            return {
                toggled: false,
                comments: [

                ]
            }
        },

        created () {
            this.printComment()
            
            this.$root.$on('comment', message => {
                let navbar = document.querySelector('.comment-collapse')
                this.comments.unshift(message)
                this.toggled = true
                navbar.classList.add('show')
            })
        },

        methods: {
            printComment() {
                this.comments = this.postData.comments
            },

            prettyDate(date){
                return momentJs(date).fromNow()
            },

            toggleComments(){
                if(this.toggled == false){
                    this.toggled = true
                } else if(this.toggled == true){
                    this.toggled = false
                }
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

    .opened {
        transform: rotate(180deg);
    }
</style>