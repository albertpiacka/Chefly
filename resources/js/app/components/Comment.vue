<script>
export default {
    props: ['comment-data'],
    data() {
        return {
            editable: false,
            visible: true,
            newText: '',
            oldText: ''
        }
    },

    mounted() {
        this.oldText = this.$refs.input.innerText
    },

    methods: {
        startEditing(){
            this.editable = true
            this.selectText()
        },

        stopEditing(){
            this.editable = false
            this.$refs.input.textContent = this.oldText
        },

        hide() {
            this.visible = false
        },

        textChanged(){
            this.newText = this.$refs.input.innerText
        },

        updateComment(){
            axios.patch('/comments/' + this.commentData.id, {
                text: this.newText
            });

            this.editable = false
            this.oldText = this.newText
        },

        deleteComment(){
            if(window.confirm('Are you sure?')){
                axios.delete('/comments/' + this.commentData.id)
                this.hide()
            }
        },

        selectText() {
            setTimeout(() => {
                let p = this.$refs.input,
                    s = window.getSelection(),
                    r = document.createRange()
                r.setStart(p, 1)
                r.setEnd(p, 1)
                s.removeAllRanges()
                s.addRange(r)
                p.focus()
            }, 0)
        }
    }
}
</script>

<style lang="scss" scoped>
    $color-hover:  rgba(230, 149, 0, 1);

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