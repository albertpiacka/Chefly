<template>
    <div class="searching">
        <div>
            <b-nav-form>
                <b-button variant="warning" class="mr-2 text-white"
                @click="reset"
                >Reset</b-button>

                <b-form-input size="sm" class="mr-sm-2 search-bar" placeholder="Search" 
                v-model="query" 
                @input="sendData"
                ></b-form-input>
            </b-nav-form>
        </div>
    </div>
</template>

<script>
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
            },

            reset(){
                this.query = ''
                this.$root.$emit('stop-searching', this.query)
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

    .btn-warning {
        border-radius: 1em !important;
    }

    .fade-enter-active, .fade-leave-active {
        transition: all .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        width: 0;
    }

</style>