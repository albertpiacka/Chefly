<template>
    <div class="user-general-box" data-aos="fade-up">
        <div class="user-header">
            <div class="user-avatar">
            </div>
            <div class="user-info">
                <div class="user-controls">
                    <div class="user-name">
                        <h4>{{user.name}}</h4>
                        <small>
                            {{userType(user.type)}}
                        </small>
                    </div>
                    <div class="user-buttons">
                        <single-link-controls resource="user" :id="user.id"/>
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
                    h4 {
                        color: #fff;
                    }

                    small {
                        color: rgb(216, 214, 214);
                    }
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