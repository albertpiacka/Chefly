<template>
    <div data-aos="fade-up">
        <h1>Dashboard</h1>

        <section class="section-1">
            <b-card
                title="Data in pie chart"
                class="text-dark"
            >
                <canvas id="allData"></canvas>

                <router-link to="/admin/users">
                    <b-button pill variant="primary">Edit users</b-button>
                </router-link>
            </b-card>

            <b-card class="text-dark card-2">
                <header v-if="this.mostLiked">
                    <h1>
                        <router-link :to="`/admin/posts/${this.mostLiked[0].slug}`">
                            <strong>{{this.mostLiked[0].title}}</strong>
                        </router-link> 
                        has most likes!
                    </h1>
                </header>

                <main v-if="this.mostLiked">
                    <div
                        v-html="shorten(this.mostLiked[0].text, 400)"
                    >
                    </div>

                    <router-link to="/admin/posts">
                        <b-button pill variant="primary" class="my-3">View posts</b-button>
                    </router-link>
                </main>
            </b-card>
        </section>

    </div>
</template>

<script>
    import tableMixin from '../mixins/tableMixin'

    export default {
        mixins: [tableMixin],
        data() {
            return {
                posts: [

                ],

                quickposts: [

                ],

                users: [

                ],

                comments: [

                ],

                mostLiked: null,
            }
        },

        mounted () {
            axios.get('/api/posts')
                 .then(response => {
                     this.posts = response.data
                     this.allData(allData, 'posts', response.data)

                     this.mostLiked = this.posts.sort((a, b) => {
                         a = a.likes.length
                         b = b.likes.length 
                         var results = a > b ? -1 : a < b ? 1 : 0;
                         return results
                     })
                 })

            axios.get('/api/quickposts')
                 .then(response => {
                    this.quickposts = response.data
                    this.allData(allData, 'quickposts', response.data)
                 })

            axios.get('/api/users')
                 .then(response => {
                     this.users = response.data
                     this.allData(allData, 'users', response.data)
                 })

            axios.get('/api/comments')
                 .then(response => {
                     this.comments = response.data
                     this.allData(allData, 'comments', response.data)
                 })

            let ctx1 = document.getElementById('allData');

            let allData = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: [],
                    datasets: [{
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9"],
                        data: []
                    }]
                },
            })
        },

        methods: {
            allData(chart, label, data) {
                chart.data.datasets[0].data.push(data.length)
                chart.data.labels.push(label)
                chart.update()
            }
        },
    }
</script>

<style lang="scss" scoped>
    h1 {
        width: 80%;
        margin: 1em auto;
        @media (max-width: 500px){
            margin: 5em auto;
        }
    }

    strong {
        color: rgba(230, 149, 0, 1);
    }

    .section-1 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 1em;
        padding: 1em;

        @media screen and (max-width: 500px){
            grid-template-columns: 1fr;
        }

        .card {
            border-radius: 2em !important;
        }

        .card-2 {
            display: grid;
            align-content: center;

            h1 {
                margin: 0;
            }

            main {
                margin: 1em 0;
            }
        }


    }

</style>