
<script>
    export default {
        props: ['post-data', 'user-data'],
        data() {
            return {
                liked: false,
                postLikes: 0,
                likes: {

                }
            }
        },

        mounted () {
           this.likes = this.postData.likes
           this.postLikes = this.postData.likes.length
           
           let likes = this.likes

           if(this.liked == true){
               this.$el.classList.add('liked')
               this.$el.classList.remove('unliked')
           } else if(this.liked == false ) {
               this.$el.classList.add('unliked')
               this.$el.classList.remove('liked')
           }
           
           if(likes){
               likes.forEach(like => {
                    if(like.user_id == this.userData.id){
                        this.$el.classList.add('liked')
                        this.$el.classList.remove('unliked')
                        this.liked = true
                    }
                });
           }
        },

        methods: {
            toggleLike(){
                if(this.liked == true){
                    let removeLike = this.likes.filter(item => item.user_id == this.userData.id)
                    this.$el.classList.remove('liked')
                    this.$el.classList.add('unliked')

                    axios.delete(`/likes/${removeLike[0].id}`)
                     .then(response => {
                         this.liked = false
                         this.likes = this.likes.filter(item => item.user_id !== this.userData.id)
                         this.postLikes--
                     })
                } else if(this.liked == false){
                    this.$el.classList.remove('unliked')
                    this.$el.classList.add('liked')
                    axios.post('/likes', {
                        post_id: this.postData.id,
                        user_id: this.userData.id
                    })
                    .then(response => {
                        this.liked = true
                        this.likes.push(response.data.like)
                        this.postLikes++
                    })
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .liked {
        color:crimson;
    }

    .likes-wrapper {
        display: flex;
        column-gap: .3em;
    }

    .likes-count {
        color: #fff;
    }
</style>