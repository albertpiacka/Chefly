export default {
    methods: {
        showModal() {
            this.$root.$emit('bv::show::modal', 'modal-sm', '#btnShow')
        },

        hideModal() {
            this.$root.$emit('bv::hide::modal', 'modal-sm', '#btnShow')
        },

        toggleModal() {
            this.$root.$emit('bv::toggle::modal', 'modal-sm', '#btnToggle')
        },

        openPost(post){
            this.openedPost = post
        },

        getInitials(name) {
            return name.charAt(0).toUpperCase()
        },

        prettyDate(date){
            return momentJs(date).fromNow()
        },
    }
}