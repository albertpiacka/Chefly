<template>
    <div class="user-general-box" data-aos="fade-up">
        <div class="user-header">
            <div class="user-avatar">
            </div>
            <div class="user-info">
                <div class="user-controls">
                    <div class="user-name">
                        <input type="text" v-model="user.name">
                        
                        <div class="user-type">
                            User type
                            <b-form-select v-model="user.type" :options="options" class="my-3 select-user"></b-form-select>
                        </div>
                        
                    </div>
                    <div>
                        <b-button class="my-buttons post-submit" @click="editComment" variant="success">Submit</b-button>
                        <b-button class="my-buttons post-cancel" @click="$router.go(-1)" variant="outline-primary">Cancel</b-button>
                    </div>
                </div>
                <div class="info-tags">
                    <div class="info-box">
                        <small>Articles</small>
                        <div class="info-num">-</div>
                    </div>
                    <div class="info-box">
                        <small>Followers</small>
                        <div class="info-num">-</div>
                    </div>
                    <div class="info-box">
                        <small>Rating</small>
                        <div class="info-num">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import tableMixin from '../../mixins/tableMixin'
    import SingleLinkControls from '../../components/SingleLinkControls'

    export default {
        mixins: [tableMixin],
        components: {
            SingleLinkControls,
        },
        data() {
            return {
                options: [
                    { value: null, text: 'Please select an option' },
                    { value: 1, text: 'Administrator' },
                    { value: 2, text: 'Editor' },
                    { value: 0, text: 'User' },
                ],

                user: {

                }
            }
        },

        mounted () {
            axios.get('/api/users/' + this.$route.params.id)
                 .then(response => {
                    this.user = response.data
                 })
                 .catch(err => {
                     return this.$router.push('/admin/404')
                 })
        },

        methods: {
            userType(type) {
                if(type == 0){
                    return 'User'
                } else if(type == 1){
                    return 'Administrator'
                } else if(type == 2){
                    return 'Editor'
                } 
            },

            editComment() {
                axios.patch(`/api/users/${this.user.id}`, this.user)
                     .then(response => {
                         this.$router.push(`/admin/users/${this.user.id}`)
                     })
            }
        },
    }
</script>

<style lang="scss" scoped>
    .user-general-box {
        background: #262525;
        color: #fff;
        border-radius: 2em;
        width: 60%;
        margin: auto;
        padding: 2em;
        position: relative;
        top: 4em;
        box-shadow: 0em 7em 10em -5em #000;

        @media (max-width: 500px){
            width: 90%;
            padding: 0;
        }

        .user-header {
            display: grid;
            grid-template-columns: 1fr 2fr;
            grid-template-rows: 1fr;
            grid-column-gap: 1em;
            width: 100%;
            margin: auto;
            
            .user-avatar {
                border-radius: 2em;
                overflow: hidden;
                height: 250px;
                min-width: 15em;
                background-size: cover;
                @media (max-width: 950px){
                    height: auto;
                }

                @media (max-width: 500px){
                    border-radius: 2em 2em 0 0;
                }
            }

            .user-info {
                display: grid;
                grid-template-columns: 1fr;
                @media (max-width: 500px){
                    padding: 2em;
                }

                .user-name {
                    input {
                        border-radius: 1em;
                        padding: .3em;
                        border: none;
                        outline: none;
                        &:focus {
                            border: none;
                            outline: none;
                        }
                    }

                    small {
                        color: rgb(216, 214, 214);
                    }
                }

                .select-user {
                    border-radius: 1em;
                }
            }

            @media (max-width: 920px){
                display: block;
                .user-avatar {
                    height: 150px;
                }
            }

            @media (max-width: 660px){
                display: block;
                margin: 0;
                .user-avatar {
                    height: 150px;
                    width: 100%;
                }
            }

            .info-tags {
                background: #e3e4e6;
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                border-radius: 1em;
                text-align: center;

                small {
                    color: #aaa;
                    font-weight: 600;
                }

                .info-num {
                    color: #000;
                    font-weight: 600;
                }
            }
        }

        .user-buttons {
            padding: .5em 0;
        }
    }
</style>