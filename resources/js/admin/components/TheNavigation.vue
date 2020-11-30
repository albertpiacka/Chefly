<template>
    <nav class="py-1">
        <b-card no-body class="bg-dark my-card">
            <b-list-group flush>

                <a class="my-link" href="/">
                    <b-list-group-item class="nav-button">
                        Home
                    </b-list-group-item>
                </a>

                <router-link class="my-link" to="/admin/">
                    <b-list-group-item class="nav-button">
                        Dashboard
                    </b-list-group-item>
                </router-link>

                <router-link class="my-link" to="/admin/posts">
                    <b-list-group-item class="nav-button">
                        Posts
                    </b-list-group-item>
                </router-link>  

                <router-link class="my-link" to="/admin/comments">
                    <b-list-group-item class="nav-button">
                        Comments
                    </b-list-group-item>
                </router-link>

                <router-link class="my-link" to="/admin/users">
                    <b-list-group-item class="nav-button">
                        Users
                    </b-list-group-item>
                </router-link>  

                
            </b-list-group>
        </b-card>
    </nav>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>
    .my-card {
        border: none;
        outline: none;
    }

    .my-link {
        transition: all .4s ease;
        color: #fff;
    }

    .nav-button {
        transition: all .4s ease;
        border-radius: 1em;
        background: #333333;
        margin: .1em auto;
        &:hover {
            background: #007bff;
            color: #fff;
        }
    }

    .router-link-exact-active {
        color: #aaa;
    }
</style>