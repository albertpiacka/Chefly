<template>
    <div class="content-wrapper" data-aos="fade-up">
        <h1>Comments</h1>
        <div class="data-table">
            <table class="table table-striped shadow-lg">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Author</th>
                    <th scope="col">Text</th>
                    <th scope="col">Created</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="comment in comments" :key="comment.id">
                        <th scope="row">{{comment.id}}</th>
                        <td>{{comment.user.name}}</td>
                        <td>{{comment.text}}</td>
                        <td>{{prettyDate(comment.created_at)}}</td>
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
                comments: [

                ]
            }
        },

        created () {
            axios.get('/api/comments')
                 .then(response => {
                     this.comments = response.data
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