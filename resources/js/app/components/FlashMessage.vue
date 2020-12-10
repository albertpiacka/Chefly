<template>
    <transition name="fade">
        <div class="alert-custom-success" v-show="visible">
            <div class="alert-custom-text">
                {{message}}
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        data() {
            return {
                visible: false,
                message: '' 
            }
        },

        mounted () {
            this.$root.$on('comment-message', data => {
                this.message = data
                this.show()
                setTimeout(() => {
                    this.hide()
                }, 5000);
            })

            this.$root.$on('edit-message', data => {
                this.message = data
                this.show()
                setTimeout(() => {
                    this.hide()
                }, 5000);
            })
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
        background: var(--color-button-bg);
        padding: .5em;
        border-radius: 1em;
        z-index: 5;
        width: 30%;
        position: fixed;
        left: 1em;
        bottom: 1em;
        text-align: center;
        .alert-custom-text {
            color: var(--color-button-switch);
        }
        @media (max-width: 500px){
            width: 50%;
        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>