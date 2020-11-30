export default {
    methods: {
        prettyDate(date) {
            return momentJs(date).format("MMM Do YY")
        },

        exactDate(date){
            return momentJs(date).format('MMMM Do YYYY, h:mm:ss a')
        },

        shorten(text, len = 50){
            return _.truncate(text, len)
        }
    },

    computed: {
        filteredItems() {
            return this.data.filter(item => {
                return item[this.searchColumn].normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },
}