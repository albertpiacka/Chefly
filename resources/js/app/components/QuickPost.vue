<template>
    <div>
        <textarea name="quickpost" id="quickpost" rows="3" placeholder="What's on your mind?"
        v-model="quickpost"
        ></textarea>
        <button @click="sendPost" class="button-primary-light">Post it</button>

        <div class="quickposts">
            <transition-group name="fade">
                <div v-for="quickpost in quickposts" :key="quickpost" class="quick-post">
                    {{ quickpost }}
                </div>
            </transition-group>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                quickpost: '',
                quickposts: [],
            }
        },

        methods: {
            sendPost() {
                this.quickposts.unshift(this.quickpost)
                this.quickpost = ''
            }
        },
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
        transform: scale(1);
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: scale(0);
    }
    
    textarea {
        width: 100%;
        padding: .5em;
        margin-top: .5em;
        border-radius: 1em;
        &:focus {
            outline: none;
        }
    }

    .quick-post {
        border: 1px solid #000;
        padding: 1em;
        margin: .5em auto;
        width: 100%;
        border-radius: 1em;
    }
</style>