<template>
    <transition name="fade">
        <div class="alert-custom-success" v-show="visible">
            <div class="alert-custom-text">
                {{text}}
            </div>
            <svg @click="hide" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ["text"],

        data() {
            return {
                visible: false      
            }
        },

        created(){
            if(this.text){
                this.show()
            }
        },

        methods: {

            show() {
                this.visible = true;

            },

            hide() {
                this.visible = false;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .alert-custom-success {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: var(--color-button-bg);
        padding: .5em;
        border-radius: 1em;
        z-index: 5;
        width: 20%;
        position: fixed;
        right: 1em;
        bottom: 1em;
        .alert-custom-text {
            color: var(--color-button-switch);
        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>