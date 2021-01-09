<template>
    <div class="searching">
        <div>
            <b-nav-form>
                <b-form-input size="sm" class="mr-sm-2 search-bar" placeholder="Search" 
                v-model="query" 
                @input="sendData"
                ></b-form-input>
            </b-nav-form>
        </div>
    </div>
</template>

<script>
    let main = document.querySelector('main')

    export default {
        data() {
            return {
                query: '',
            }
        },

        methods: {
            sendData(){
                this.$root.$emit('searching', this.query)
            },

            stopSearching(){
                let main = document.querySelector('main')
                main.classList.remove('blurred')
            }
        },

        watch: {
            query(oldValue) {
                if(oldValue == ''){
                    this.stopSearching()
                }
            }
        },
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