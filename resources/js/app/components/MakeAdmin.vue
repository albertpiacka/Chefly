<template>
    <div>
        <button @click="makeAdmin">make me admin</button>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        methods: {
            makeAdmin() {
                axios.patch(`/users/${this.user.id}`)
                 .then(res => {
                     console.log(res);
                 })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>