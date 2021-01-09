<template>

    <div class="content">
        <div class="fixed-top">
            <nav class="navbar navbar-dark bg-dark navbar-wrapper">
                <div class="toggle-wrapper">
                    <h4 class="site-name text-white p-1 pr-5"><a class="text-muted" href="/">Chefly</a></h4>
                    <b-button v-b-toggle.sidebar-backdrop>
                        <span class="navbar-toggler-icon"></span>
                    </b-button>
                </div>
                <div class="search-wrapper">
                    <search-form></search-form>
                </div>
            </nav>
        </div>
        <div class="content-wrapper">
            <div class="side-bar-menu">
                <div>
                    <b-sidebar
                    id="sidebar-backdrop"
                    bg-variant="dark"
                    text-variant="light"
                    backdrop
                    shadow
                    >
                    <the-navigation/>
                    <template #footer="{ hide }">
                        <div class="d-flex bg-dark text-light align-items-center px-3 py-2">
                            <b-button size="sm" @click="hide(), logout()" >Log out</b-button>
                        </div>
                    </template>
                    </b-sidebar>
                </div>
            </div>
            <div class="main">
                <div class="main-wrapper">
                    <router-view></router-view>
                </div>
            </div>

            <b-modal id="bv-modal-example" hide-footer>
                <template #modal-title>
                    <div class="modal-heading">
                        Are you sure you want to delete this?
                    </div>
                </template>
                <b-button class="mt-3" @click="$bvModal.hide('bv-modal-example'), deleteResource()">Delete</b-button>
                <b-button class="mt-3" @click="$bvModal.hide('bv-modal-example')">Cancel</b-button>
            </b-modal>

        </div>
    </div>
    
</template>

<script>
    import tableMixin from './mixins/tableMixin'
    import TheNavigation from './components/TheNavigation'
    import SearchForm from './components/SearchForm'
    
    export default {
        mixins: [tableMixin],
        components: {
            TheNavigation,
            SearchForm,
        },

        data() {
            return {
                user: null,
                deleteData: [

                ]
            }
        },

        mounted () {
            this.returnUser()

            this.$root.$on('delete-data', data => {
                this.deleteData = data
            })
        },

        methods: {
            deleteResource() {
                axios.delete('/api/' + this.deleteData[0] + 's/' + this.deleteData[1])
                     .then(response => {
                         this.$root.$emit('delete-this', this.deleteData)
                         
                         this.$bvToast.toast(`${response.data.message}`, {
                                variant: 'warning',
                                solid: true
                            })
                     })
                     .catch(err => {
                         this.$bvToast.toast(`${err.response.data.message}`, {
                                variant: 'warning',
                                solid: true
                            })
                     })
            },
            
            logout(){
                axios.post('/logout')
                return this.$router.go()
            }
        },
    }
</script>

<style lang="scss" scoped>
    
    .content {
        .toggle-wrapper {
            display: flex;
            flex: row wrap;
            justify-content: space-evenly;
            .site-name {
                @media (max-width: 560px){
                    display: none;
                }
            }
        }

        .search-wrapper {
            @media (max-width: 500px){
                display: block;
                width: 100%;
                margin: .5em auto;
            }
        }

        .main {
            margin: 5em auto;
            @media (max-width: 600px){
                margin-top: 10em;
            }
        }
    }

    .modal-heading {
        color: #000;
    }

</style>