<template>
    <div data-aos="fade-up">
        <h1>Dashboard</h1>

        <div class="chart">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [

                ],

                users: [

                ],

                comments: [

                ]
            }
        },

        mounted () {
            axios.get('/api/posts')
                 .then(response => {
                     this.posts = response.data
                     this.addData(myChart, 'posts', response.data.length)
                 })

            axios.get('/api/users')
                 .then(response => {
                     this.users = response.data
                     this.addData(myChart, 'users', response.data.length)
                 })

            axios.get('/api/comments')
                 .then(response => {
                     this.comments = response.data
                     this.addData(myChart, 'comments', response.data.length)
                 })

            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: [],
                    datasets: [{
                        label: '',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },

        methods: {
            addData(chart, label, data) {
                chart.data.labels.push(label);
                chart.data.datasets.forEach((dataset) => {
                    dataset.data.push(data);
                });
                chart.update();
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

    .chart {
        padding: 1em;
    }


</style>