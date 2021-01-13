<template>
    
</template>

<script>
    export default {
        mounted () {
            this.$root.$on('flash', data => {
                this.makeToast(data)
            })
        },

        methods: {
            makeToast(message) {
                this.$bvToast.toast(message, {
                    autoHideDelay: 5000,
                    variant: 'warning',
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>