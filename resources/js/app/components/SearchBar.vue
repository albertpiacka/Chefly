
<script>
    export default {
        data() {
            return {
                search: '',
            }
        },

        methods: {
            returnData() {
                this.$root.$emit('search', this.search)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>