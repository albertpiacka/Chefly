
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
                this.$el.classList.toggle('liked')

                if(this.liked == true){
                    let removeLike = this.likes.filter(item => item.user_id == this.userData.id)

                    axios.delete(`/likes/${removeLike[0].id}`)
                     .then(response => {
                         this.liked = false
                         this.likes = this.likes.filter(item => item.user_id !== this.userData.id)
                     })
                } else if(this.liked == false){
                    axios.post('/likes', {
                        post_id: this.postData.id,
                        user_id: this.userData.id
                    })
                    .then(response => {
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