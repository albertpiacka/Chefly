<template>
    <transition name="fade">
        <div class="alert-custom-success" v-show="visible">
            <div class="alert-custom-text">
                {{text}}
            </div>
            <button @click="hide">X</button>
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
            this.show()
        },

        methods: {

            show() {
                this.visible = true;
                setTimeout(() => {
                    this.hide()
                }, 3000);
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
        background: #fff;
        padding: .5em;
        border-radius: 1em;
        z-index: 5;
        width: 20%;
        position: fixed;
        right: 1em;
        bottom: 1em;
        color: #000;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>