<template>
    <div class="content-wrapper" data-aos="fade-up">
        <h1>Users</h1>
        <div class="data-table">
            <table class="table table-striped shadow-lg">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <th scope="row">{{user.id}}</th>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{prettyDate(user.created_at)}}</td>
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
                users: [

                ]
            }
        },

        created () {
            axios.get('/api/users')
                 .then(response => {
                     this.users = response.data
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