<template>
    <div class="content-wrapper" data-aos="fade-up">
        <h1>Posts</h1>
        <div class="data-table">
            <table class="table table-striped shadow-lg">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Text</th>
                    <th scope="col">Created</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts" :key="post.id">
                        <th scope="row">{{post.id}}</th>
                        <td>{{post.title}}</td>
                        <td>{{post.text}}</td>
                        <td>{{prettyDate(post.created_at)}}</td>
                    </tr>
                </tbody>    
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [

                ]
            }
        },

        created () {
            axios.get('/api/posts')
                 .then(response => {
                     this.posts = response.data
                 });
        },

        methods: {
            prettyDate(date) {
                return momentJs(date).format("MMM Do YY")
            }
        },
    }
</script>

<style lang="scss" scoped>
    
</style>