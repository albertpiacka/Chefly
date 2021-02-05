<template>
    <div data-aos="fade-up">
        <h1 class="py-2">Edit quickpost</h1>
        <new-quickpost-form 
        :errors="errors"
        :quickpost="quickpost"
        meta="edit"
        @quickpost-form-submitted="sendForm"
        />
    </div>
</template>

<script>
    import newQuickpostForm from './newQuickpostForm'

    export default {
        components: {
            newQuickpostForm,
        },
         
        data() {
            return {
                errors: {},
                quickpost: {},
            }
        },

        created () {
            axios.get('/api/quickposts/' + this.$route.params.id)
                 .then(response => {
                     this.quickpost = response.data
                 })
        },

        methods: {
            sendForm(data) {
                axios.patch(`/api/quickposts/${data.id}`, data)
                     .then(response => {
                        this.$router.push(`/admin/quickposts/${response.data.quickpost.id}`)
                     })
            },
        },
    }
</script>

<style lang="scss" scoped>
    h1 {
        width: 80%;
        margin: 1em auto;
        @media (max-width: 500px){
            margin: 5em auto;
        }
    }
</style>