<template>
    <div class="chat">
        <svg @click="toggleChat" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-chat-dots-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </svg>

        <transition name="fade">
            <div class="chat-box" v-show="visible">
                <svg @click="toggleChat" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>

                <div v-for="usersConversation in usersConversations" :key="usersConversation.id">
                    <div v-for="user in usersConversation.users" :key="user.id">
                        <div class="user-conversation" v-if="user.id != authUser.id">
                            {{user.name}}
                        </div>
                    </div>
                </div>

                <div class="chat-form" v-show="userOpened">
                    <input type="text" v-model="message" placeholder="Type something">
                    <svg @click="sendMessage" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-caret-up-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                    </svg>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['user', 'conversations'],
        data() {
            return {
                visible: false,
                userOpened: false,
                usersConversations: [],
                currentUser: [],
                authUser: [],
                message: '',
            }        
        },

        mounted () {
            this.usersConversations = this.conversations
            this.authUser = this.user
            this.$root.$on('open-chat', data => {
                this.currentUser = data
                this.visible = true
                this.userOpened = true
                // First we have to find out if there are conversation.. if yes, then skip this and open conversation
                // Transform this to work with user's conversations.. compare user's conversations with your conversations
                // for(let i = 0; i < arr1.length; i++){
                //     if(arr1.includes(arr2[i])){
                //         console.log(arr2[i])
                //     }
                // }
            })
        },

        methods: {
            toggleChat() {
                if(this.visible == false){
                    this.visible = true
                } else if (this.visible == true){
                    this.visible = false
                }
            },

            setUser(user){
                this.currentUser = user
                this.userOpened = true
            },

            makeConversation(){
                let data = {
                    name: `${this.user.name}_${this.currentUser.name}`,
                    user_one: this.user.id,
                    user_two: this.currentUser.id,
                    users: [
                        this.user.id,
                        this.currentUser.id
                    ]
                };
                axios.post('/conversations', data)
                     .then(response => {
                         console.log(response)
                     })
            },

            sendMessage(){
                
            }
        },
    }
</script>

<style lang="scss" scoped>
    .bi {
        cursor: pointer;
    }

    .bi-x-circle {
        float: right;
    }

    .bi-caret-up-fill {
        color: #fff;
    }

    .bi-chat-dots-fill {
        position: fixed;
        right: 2em;
        bottom: 2em;
    }

    .chat {
        position: relative;
    }

    .chat-box {
        position: fixed;
        right: 5em;
        bottom: 2em;
        width: 300px;
        height: 60%;
        z-index: 100000;
        border-radius: 2em;
        padding: 1em;
        background: #000;
        .user {
            cursor: pointer;
        }
    }

    .chat-form {
        position: absolute;
        display: block;
        bottom: 1em;
        text-align: center;
        display: grid;
        width: 100%;
        grid-template-columns: 4fr 1fr;
        grid-column-gap: .1em;
        input {
            border-radius: 1em;
            padding: .2em;
            border: none;
            outline: none;
        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: all .3s;
        transform: scale(1);
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: scale(0);
    }
</style>