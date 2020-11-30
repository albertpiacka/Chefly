

<script>
    export default {
        props: ['users-data'],
        data() {
            return {
                search: '',
                users: [

                ],
            }
        },

        mounted () {
            this.users = this.usersData
            this.$root.$on('search', data => {
                this.search = data
            })            
        },

        computed: {
            filteredItems() {
                return this.users.filter(item => {
                    return item['name'].normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(this.search.toLowerCase())
                })
            }
        },

        methods: {
            prettyDate(date) {
                return momentJs(date).format("MMM Do YY")
            }
        },
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>