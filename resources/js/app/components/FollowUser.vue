
<script>
    export default {
        props: ['user-data', 'follower-data', 'followers'],
        data() {
            return {
                following: false,
                followText: 'Follow',
                follows: {

                }
            }
        },

        mounted () {
            let followers = this.followers

            this.follows = followers

            followers.forEach(follower => {
                if(follower.follower_id == this.followerData.id){
                    this.following = true
                    this.followText = 'Unfollow'
                }
            });

        },

        methods: {
            toggleFollow() {
                if(this.following == true){
                    let removeFollow = this.follows.filter(item => item.follower_id == this.followerData.id)

                    axios.delete(`/follows/${removeFollow[0].id}`)
                     .then(response => {
                        this.following = false
                        this.followText = 'Follow'
                        this.follows = this.follows.filter(item => item.follower_id !== this.followerData.id)
                     })

                } else if(this.following == false){
                    axios.post('/follows', {
                        user_id: this.userData.id, 
                        follower_id: this.followerData.id
                    })
                    .then(response => {
                        this.following = true
                        this.followText = 'Unfollow'
                        this.follows.push(response.data.follow)
                    })
                }
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>