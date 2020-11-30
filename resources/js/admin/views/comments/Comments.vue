<template>
    <div class="content-wrapper" data-aos="fade-up">
        <b-card bg-variant="dark" text-variant="white" title="Comments" class="py-2" style="border-radius: 1em 1em 0 0">
            <transition name="fade">
                <b-card-text v-show="loaded">
                    <span v-show="searching">{{filteredItems.length}} of </span>{{data.length}} comments so far!
                </b-card-text>
            </transition>
        </b-card>
        <div class="data-table">
            <div class="table-skeleton" v-show="loading">
                <b-skeleton-table
                    :rows="10"
                    :columns="6"
                    :table-props="{ bordered: true, striped: true}"
                >
                </b-skeleton-table>
            </div>
            <table class="table table-striped shadow-lg" v-show="loaded">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Author</th>
                        <th scope="col">Text</th>
                        <th scope="col">Post</th>
                        <th scope="col">Created</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <transition-group tag="tbody" name="fade">
                    <tr v-for="comment in filteredItems" :key="comment.id">
                        <th scope="row">{{comment.id}}</th>
                        <td>{{comment.user.name}}</td>
                        <td>{{shorten(comment.text)}}</td>
                        <td>
                            <router-link class="text-muted" :to="'/admin/posts/' + comment.post.slug">{{shorten(comment.post.title, 10)}}  ➜</router-link>
                        </td>
                        <td>{{prettyDate(comment.created_at)}}</td>
                        <td>
                            <table-controls class="text-muted" resource="comment" :id="comment.id" />
                        </td>
                    </tr>
                </transition-group>   
            </table>
        </div>
    </div>
</template>

<script>
    import tableMixin from '../../mixins/tableMixin'
    import tableControls from '../../components/TableControls'
    export default {
        mixins: [tableMixin],
        components: {
            tableControls,
        },
        data() {
            return {
                search: '',
                searching: false,
                loaded: false,
                loading: true,
                searchColumn: 'text',
                data: [

                ]
            }
        },

        created () {
            axios.get('/api/comments')
                 .then(response => {
                    this.data = response.data
                    this.loaded = true
                    this.loading = false
                 })
                 .catch(error => {
                    return this.$router.push('/admin/404')
                 })
        },

        mounted () {
            this.$root.$on('nav-search', data => {
                this.search = data
                this.searching = true
            })

            this.$root.$on('delete-this', data => {
                this.data = this.data.filter(item => item.id !== data[1])
            })
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

    .content-wrapper {
        width: 80%;
        margin: auto;
        @media (max-width: 500px){
            width: 100%;
        }
    }
</style>