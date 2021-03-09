<template>
    <div class="user-wrapper">
        <div class="mb-2">
            <a href="/login" class="profile-link header-link" ref="profile-link" v-if="this.user.image">
                <b-avatar class="user-avatar" :src="baseUrl + '/storage/users-images/' + this.user.image"></b-avatar>
            </a>

            <a href="/login" class="profile-link header-link" ref="profile-link" v-if="!this.user.image">
                <b-avatar class="user-avatar" variant="primary" :text="this.initials"></b-avatar>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'user',
            'base-url'
        ],
        data() {
            return {
                initials: '',
                counter: 0,
            }
        },

        mounted () {
            this.getInitials()
        },

        methods: {
            getInitials() {
                this.initials = this.user.name.charAt(0).toUpperCase()
            },
        },
    }
</script>

<style lang="scss" scoped>
    
</style>