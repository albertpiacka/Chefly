<template>
    <form class="form-inline" @submit.prevent>
        <input v-model="searchQuery" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button @click="resetQuery" class="btn btn-outline-success my-2 my-sm-0" type="submit">Reset</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                searchQuery: ''
            }
        },

        watch: {
            searchQuery(value) {
                this.$root.$emit('nav-search', value)
            }
        },

        methods: {
            resetQuery() {
                this.searchQuery = ''
            }
        },
    }
</script>

<style lang="scss" scoped>
    input, button {
        border-radius: 1em;
        @media (max-width: 500px){
            font-size: 120%;
        }
    }
</style>