<template>
    
</template>

<script>
    export default {
        mounted () {
            this.$root.$on('flash', message => {
                this.makeToast(message)
            })

            this.getFollow('hey')
        },

        methods: {
            makeToast(message) {
                this.$bvToast.toast(message, {
                    autoHideDelay: 5000,
                    variant: 'warning',
                })
            },

            async getFollow(val){
                
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>