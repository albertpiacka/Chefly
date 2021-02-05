<template>
    <div data-aos="fade-up">
        <h1 class="py-2">New quickpost</h1>
        <new-quickpost-form 
        :errors="errors"
        meta="new"
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
                errors: {}
            }
        },

        methods: {
            sendForm(data) {
                axios.post('/api/quickposts', data)
                     .then(response => {
                        this.$router.push(`/admin/quickposts/${response.data.quickpost.id}`)
                     })
                     .catch(err => {
                        this.errors = err.response.data.errors  
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