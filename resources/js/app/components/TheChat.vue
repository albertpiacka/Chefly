<template>
    <div class="chat">
        <svg @click="toggleChat" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-chat-dots-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </svg>

        <div class="counter" v-if="counter >= 1">
            {{counter}}
        </div>

        <transition name="fade">
            <div class="chat-box" v-show="visible">
                <div class="chat-wrapper">
                    <div class="chat-header">
                        <svg @click="returnBack" width="1.5em" v-show="userOpened" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>

                        <svg @click="toggleChat" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>

                <div :class="{ conversations: !userOpened }">
                        <div v-for="usersConversation in usersConversations" :key="usersConversation.id" :class="{ conversation: !userOpened }">
                            <transition-group name="fade"> 
                                <div v-for="user in usersConversation.users" :key="user.id">
                                    <div @click="setUser(user, usersConversation)" class="user-conversation" v-if="user.id != authUser.id">
                                        {{user.name}}
                                    </div>
                                </div>
                                <small :key="usersConversation.id" v-show="!userOpened" class="conv-date">
                                    {{prettyDate(usersConversation.updated_at)}}
                                </small>
                                <div class="conv-counter text-dark" 
                                    v-if="usersConversation.counter >= 1 && !userOpened" 
                                    :key="usersConversation.id + 1"
                                >
                                    {{usersConversation.counter}}
                                </div>
                            </transition-group>

                            <div :class="{ messages: userOpened }">
                                <transition-group name="fade">
                                    <div 
                                        v-for="message in usersConversation.messages" :key="message.id + '1'" v-show="userOpened"
                                        class="message"
                                    >
                                        <div class="msg-date">
                                            {{ prettyDate(message.created_at) }}
                                        </div>
                                        <div :class="[{ alignRight: message.sender_id == authUser.id}, {alignLeft: message.sender_id !== authUser.id}]">
                                            {{ message.text }}
                                        </div>
                                    </div>
                                </transition-group>
                            </div>
                        </div>
                </div>

                    <div class="chat-form" v-show="userOpened">
                        <input @keydown.enter="sendMessage" type="text" v-model="message" placeholder="Type something" ref="message">
                        <svg @click="sendMessage" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-caret-up-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import Pusher from "pusher-js"
    export default {
        props: ['user', 'conversations'],
        data() {
            return {
                counter: 0,
                visible: false,
                userOpened: false,
                usersConversations: [],
                currentUser: [],
                currentConversation: [],
                authUser: [],
                message: '',
                notifications: 0,
            }        
        },

        mounted () {
            this.usersConversations = this.conversations
            this.authUser = this.user

            this.usersConversations.forEach(conv => {
                conv['counter'] = 0
            })

            this.$root.$on('open-chat', data => {
                if(this.currentUser == data[0]){
                    this.visible = true
                    return
                }
                this.currentUser = data[0]
                this.visible = true
                
                if(data[1].length > 0){
                    let foundConv = []
                    data[1].forEach(val => {
                        if(this.usersConversations.filter(conv => conv.id == val.id)){
                            let conversation = this.usersConversations.filter(conv => conv.id == val.id)
                            if(conversation.length > 0){
                                foundConv.push(conversation)
                            } 
                        } 
                    });

                    if(foundConv[0]){
                        this.usersConversations = foundConv[0]
                        this.currentConversation = foundConv[0]
                        this.userOpened = true
                        setTimeout(() => {
                            var container = this.$el.querySelector('.messages');
                            let conChild = container.children
                            let lastMsg = conChild[0].children
                            if(lastMsg[lastMsg.length - 1]){
                                lastMsg[lastMsg.length - 1].scrollIntoView({behavior: 'smooth'})
                            }
                        }, 100);
                    } else this.makeConversation() 
                } else {
                    this.makeConversation()      
                }
            })

            // We use pusher instead of long polling for fetching real time messages
            Pusher.logToConsole = false;

            var pusher = new Pusher('980acf677d5003fb8ac6', {
                cluster: 'eu'
            });

            var channel = pusher.subscribe('chat');
            channel.bind('MessageSent', (data) => {
                this.usersConversations.forEach(conv => {
                    if(conv.id == data[0].conversation_id){
                        conv.messages.push(data[0])

                        setTimeout(() => {
                            var container = this.$el.querySelector(".messages")
                            if(container){
                                let conChild = container.children
                                let lastMsg = conChild[0].children
                                lastMsg[lastMsg.length - 1].scrollIntoView({behavior: 'smooth'})
                            }
                        }, 100);

                        if(data[0].receiver_id == this.authUser.id){
                            this.counter++
                            this.$root.$emit('flash', 'You have a new message!')

                            let found = this.usersConversations.filter(c => c.id == conv.id)

                            found[0].counter++
                            
                        } else this.$root.$emit('flash', 'Message sent!')
                    }
                }) 
            });
        },

        methods: {
            toggleChat() {
                if(this.visible == false){
                    this.visible = true
                } else if (this.visible == true){
                    this.visible = false
                }
            },

            returnBack(){
                this.currentUser = []
                this.currentConversation = []
                this.userOpened = false
                this.usersConversations = this.conversations 
            },

            setUser(user, usersConversation){
                this.currentUser = user
                this.userOpened = true
                this.currentConversation = [usersConversation]
                this.usersConversations = [usersConversation]

                let found = this.usersConversations.filter(c => c.id == usersConversation.id)

                found[0].counter = 0

                this.counter--
                setTimeout(() => {
                    var container = this.$el.querySelector(".messages");
                    container.scrollTop = container.scrollHeight;
                }, 100);
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
                }

                axios.post('/conversations', data)
                     .then(response => {
                         this.conversations.push(response.data)
                         this.setUser(this.currentUser, response.data)
                         this.$root.$emit('new-conversation', response.data)
                     })

            },

            sendMessage(){
                let data = {
                    text: this.message,
                    conversation_id: this.currentConversation[0].id,
                    sender_name: this.user.name,
                    receiver_name: this.currentUser.name,
                    sender_id: this.user.id,
                    receiver_id: this.currentUser.id,
                }
                axios.post('/messages', data)
                this.$refs.message.value = ''
                this.message = ''
            },

            prettyDate(date) {
                return momentJs(date).fromNow();
            },
        },
    }
</script>

<style lang="scss" scoped>
    .bi {
        cursor: pointer;
    }

    .bi-caret-up-fill {
        color: #fff;
    }

    .bi-chat-dots-fill {
        position: fixed;
        right: 2em;
        bottom: 2em;
        z-index: 10;
    }

    .counter {
        position: fixed;
        right: 2em;
        bottom: 4em;
        z-index: 10;
    }

    .chat {
        position: relative;
    }

    ::-webkit-scrollbar {
        width: 0px;  
        background: transparent;  
    }

    .message {
        margin: 1em 0;
    }

    .alignRight {
        background: rgba(230, 149, 0, 1);
        border-radius: 2em;
        padding: 0.2em 0.8em;
        margin: .2em 0;
        color: #000;
        width: 90%;
        margin-left: 10%;
    }

    .alignLeft {
        background: #fff;
        border-radius: 2em;
        padding: 0.2em 0.8em;
        margin: .2em 0;
        color: #000;
        display: block;
        // border: 1px solid #fff;
        width: 90%;
        margin-right: 10%;
    }

    .chat-box {
        position: fixed;
        right: 5em;
        bottom: 2em;
        width: 300px;
        height: 60%;
        z-index: 100000000000;
        border-radius: 2em;
        border: 2px solid #000;
        padding: 1em;
        background: #000;
        color: #fff;
        transition: all .4s ease;
        overflow: auto;
        overflow-x: hidden;

        .chat-header {
            display: flex;
            justify-content: space-between;
            padding: .2em;
        }

        .conversations {
            display: grid;
            grid-template-columns: 1fr;
            grid-row-gap: 1em;
            .conversation {
                background: #fff;
                border-radius: 1.5em;
                padding: .5em;
                cursor: pointer;
            }
        }

        .conv-date {
            color: rgb(233, 189, 109);
        }

        .msg-date {
            font-size: 70%;
            text-align: center;
        }

        .user-conversation {
                cursor: pointer;
                color: rgba(230, 149, 0, 1);
        }

        @media (max-width: 500px){
            width: 98%;
            left: 1%;
            bottom: 4em;
            height: 80%;
        }
    }

    .messages {
        overflow: auto;
        position: absolute;
        height: 70%;
        width: 90%;
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
        transition: all .2s;
        transform: scale(1);
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: scale(0);
    }
</style>