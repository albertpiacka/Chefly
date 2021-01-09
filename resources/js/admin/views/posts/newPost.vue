<template>
    <div data-aos="fade-up">
        <h1 class="py-2">New post</h1>
        <new-post-form 
        :errors="errors"
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
                errors: [],
            } 
        },

        methods: {
            sendForm(data) {
                axios.post('/api/posts', data)
                     .then(response => {
                        console.log(response)
                        this.$router.push(`/admin/posts/${response.data.post.slug}`)
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