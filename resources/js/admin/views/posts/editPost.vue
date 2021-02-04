<template>
    <div data-aos="fade-up">
        <h1 class="py-2">Edit post</h1>
        <new-post-form 
        :errors="errors"
        :post="post"
        meta="edit"
        @post-form-submitted="sendForm"
        />
    </div>
</template>

<script>
    import newPostForm from './newPostForm.vue'

    export default {
        components: {
            newPostForm,
        },
         
        data() {
            return {
                errors: {},
                post: {},
            }
        },

        created () {
            axios.get('/api/posts/' + this.$route.params.slug)
                 .then(response => {
                     this.post = response.data
                 })
        },

        methods: {
            sendForm(data) {
                axios.patch(`/api/posts/${data.id}`, data)
                     .then(response => {
                        this.$router.push(`/admin/posts/${response.data.post.slug}`)
                     })
                     .catch(err => {
                        this.errors = err.response.data.errors 
                        this.$bvToast.toast(`${err.response.data.message}`, {
                                variant: 'warning',
                                solid: true
                            })  
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