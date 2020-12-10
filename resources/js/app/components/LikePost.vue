
<script>
    export default {
        props: ['post-data', 'user-data'],
        data() {
            return {
                liked: false,
                likes: {

                }
            }
        },

        mounted () {
           this.likes = this.postData.likes
           
           let likes = this.likes

           if(this.liked == true){
               this.$el.classList.add('liked')
           } else if(this.liked == false ) {
               this.$el.classList.add('unliked')
           }
           
           if(likes){
               likes.forEach(like => {
                    if(like.user_id == this.userData.id){
                        this.$el.classList.add('liked')
                        this.liked = true
                    }
                });
           }
        },

        methods: {
            toggleLike(){
                if(this.liked == true){
                    let removeLike = this.likes.filter(item => item.user_id == this.userData.id)

                    axios.delete(`/likes/${removeLike[0].id}`)
                     .then(response => {
                         this.$el.classList.remove('liked')
                         this.$el.classList.add('unliked')
                         this.liked = false
                         this.likes = this.likes.filter(item => item.user_id !== this.userData.id)
                     })
                } else if(this.liked == false){
                    axios.post('/likes', {
                        post_id: this.postData.id,
                        user_id: this.userData.id
                    })
                    .then(response => {
                        this.$el.classList.remove('unliked')
                        this.$el.classList.add('liked')
                        this.liked = true
                        this.likes.push(response.data.like)
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
</style>