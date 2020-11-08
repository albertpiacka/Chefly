<template>
    <form class="form-inline">
        <input v-model="message" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>