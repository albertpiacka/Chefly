<template>
    <nav class="py-5">
        <b-card no-body header="Card with flush list group">
            <b-list-group flush>
                <b-list-group-item href="#">
                    <router-link class="text-dark" to="/admin/">Dashboard</router-link>
                </b-list-group-item>

                <b-list-group-item href="#">
                    <router-link class="text-dark" to="/admin/posts">Posts</router-link>    
                </b-list-group-item>

                <b-list-group-item href="#">
                    <router-link class="text-dark" to="/admin/comments">Comments</router-link>    
                </b-list-group-item>

                <b-list-group-item href="#">
                    <router-link class="text-dark" to="/admin/users">Users</router-link>  
                </b-list-group-item>
            </b-list-group>
        </b-card>
    </nav>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>