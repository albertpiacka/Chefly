<template>
    <div>
        <transition name="fade">
            <div class="results" v-show="searching">
                <transition-group
                    name="staggered-fade"
                    tag="ul"
                    v-bind:css="false"
                    v-on:before-enter="beforeEnter"
                    v-on:enter="enter"
                    v-on:leave="leave"
                >
                    <div v-if="this.filteredData" key="no-result" v-show="this.filteredData.length == 0">
                        <div class="no-result" v-if="this.filteredData.length == 0">
                            Nothing was found 
                        </div>
                    </div>

                    <div v-for="search in this.filteredData" :key="search.id" class="searched-item">
                        <div class="searched-items-wrapper">
                            <div v-if="search.name">
                                <a :href="'/users/' + search.id" class="profile-link header-link" ref="profile-link" v-if="search.image">
                                    <b-avatar class="user-avatar" :src="baseUrl + '/users-images/' + search.image"></b-avatar>
                                </a>

                                <a :href="'/users/' + search.id" class="profile-link header-link" ref="profile-link" v-if="!search.image">
                                    <b-avatar class="user-avatar" variant="warning" :text="getInitials(search.name)"></b-avatar>
                                </a>
                            </div>

                            <div v-if="search.title">
                                <a :href="'/users/' + search.user.id" class="profile-link header-link" ref="profile-link" v-if="search.user.image">
                                    <b-avatar class="user-avatar" :src="baseUrl + '/users-images/' + search.user.image"></b-avatar>
                                </a>

                                <a :href="'/users/' + search.user.id" class="profile-link header-link" ref="profile-link" v-if="!search.user.image">
                                    <b-avatar class="user-avatar" variant="warning" :text="getInitials(search.user.name)"></b-avatar>
                                </a>
                            </div>
                            
                            <div v-if="search.name">
                                <a :href="'/users/' + search.id">{{ search.name }}</a>
                            </div>
                            <div v-if="search.title">
                                <a :href="'/posts/' + search.slug">{{ search.title }}</a>
                            </div>
                        </div>
                    </div>
                </transition-group>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['baseUrl'],
        data() {
            return {
                data: [],
                query: '',
                searching: false,
            }
        },

        mounted () {
            this.getData()

            this.$root.$on('searching', query => {
                this.query = query
                this.searching = true
                let main = document.querySelector('main')
                main.classList.add('blurred')
            })

            this.$root.$on('stop-searching', query => {
                this.query = query
                this.searching = false
                let main = document.querySelector('main')
                main.classList.remove('blurred')
            })
        },

        methods: {
            getData(){
                axios.get('/api/posts')
                 .then(r => {
                     r.data.forEach(val => {
                         this.data.push(val)
                     })
                 })

                axios.get('/api/users')
                 .then(r => {
                     r.data.forEach(val => {
                         this.data.push(val)
                     })
                 })
            },

            getInitials(name){
                return name.charAt(0).toUpperCase()
            },

            beforeEnter: function (el) {
                el.style.opacity = 0
                el.style.height = 0
            },

            enter: function (el, done) {
                var delay = el.dataset.index * 150
                setTimeout(function () {
                    Velocity(
                    el,
                    { opacity: 1, height: '3em' },
                    { complete: done }
                    )
                }, delay)
            },

            leave: function (el, done) {
                var delay = el.dataset.index * 150
                setTimeout(function () {
                    Velocity(
                    el,
                    { opacity: 0, height: 0 },
                    { complete: done }
                    )
                }, delay)
            }
        },

        computed: {
            filteredData: function () {
                if(this.query !== ''){
                    return this.data.filter(val => {
                        if(val['name']){
                            return val['name'].normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(this.query.toLowerCase())
                        } else if(val['title']){
                            return val['title'].normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(this.query.toLowerCase())
                        } else if(val['text']){
                            return val['text'].normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(this.query.toLowerCase())
                        }
                    })
                } else this.searching = false
            }
        }
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: all .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        width: 0;
    }
</style>