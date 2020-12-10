<template>
    <div>
        <button @click="openChat">Send message</button>
    </div>
</template>

<script>
    export default {
        props: ['user-data', 'user-conversations'],
        data() {
            return {
                
            }
        },

        mounted () {
            this.$root.$on('new-conversation', data => {
                this.userConversations.push(data)
            })
        },

        methods: {
            openChat() {
                this.$root.$emit('open-chat', [this.userData, this.userConversations])
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>