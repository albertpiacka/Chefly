<template>
    <div>
        <button @click="openChat">Send message</button>
    </div>
</template>

<script>
    export default {
        props: ['user-data'],
        data() {
            return {
                
            }
        },

        methods: {
            openChat() {
                this.$root.$emit('open-chat', this.userData)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>