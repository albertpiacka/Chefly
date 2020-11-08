<template>

    <div class="content">
        <div class="fixed-top" style="z-index: 1050">
            <nav class="navbar navbar-dark bg-dark">
                <div class="col toggle-wrapper">
                    <h4 class="site-name text-white">Chefly</h4>
                    <b-button v-b-toggle.sidebar-backdrop>
                        <span class="navbar-toggler-icon"></span>
                    </b-button>
                </div>
                <div class="col col-md-auto">
                    <search-form></search-form>
                </div>
            </nav>
        </div>
        <div class="content-wrapper">
            <div class="side-bar-menu">
                <div>
                    <b-sidebar
                    id="sidebar-backdrop"
                    title="Sidebar with backdrop"
                    backdrop
                    shadow
                    >
                    <the-navigation/>
                    <template #footer="{ hide }">
                        <div class="d-flex bg-dark text-light align-items-center px-3 py-2">
                            <strong class="mr-auto">Footer</strong>
                            <b-button size="sm" @click="hide">Close</b-button>
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
        </div>
    </div>

    
</template>

<script>
    import TheNavigation from './components/TheNavigation'
    import SearchForm from './components/SearchForm'
    export default {
        components: {
            TheNavigation,
            SearchForm,
        }
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

        .main {
            width: 80%;
            margin: 4em auto;
        }
    }

</style>