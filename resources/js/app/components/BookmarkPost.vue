
<script>
    export default {
        props: ['post-data', 'user-data'],
        data() {
            return {
                bookmarked: false,
                bookmarks: {

                }
            }
        },

        mounted () {
           this.bookmarks = this.postData.bookmarks
           
           let bookmarks = this.bookmarks

           if(this.bookmarked == true){
               this.$el.classList.add('bookmarked')
               this.$el.classList.remove('unbookmarked')
           } else if(this.bookmarked == false ) {
               this.$el.classList.add('unbookmarked')
               this.$el.classList.remove('bookmarked')
           }
           
           if(bookmarks){
               bookmarks.forEach(bookmark => {
                    if(bookmark.user_id == this.userData.id){
                        this.$el.classList.add('bookmarked')
                        this.$el.classList.remove('unbookmarked')
                        this.bookmarked = true
                    }
                });
           }
        },

        methods: {
            toggleBookmark(){
                if(this.bookmarked == true){
                    let removeBookmark = this.bookmarks.filter(item => item.user_id == this.userData.id)

                    axios.delete(`/bookmarks/${removeBookmark[0].id}`)
                     .then(response => {
                         this.$el.classList.remove('bookmarked')
                         this.$el.classList.add('unbookmarked')
                         this.bookmarked = false
                         this.bookmarks = this.bookmarks.filter(item => item.user_id !== this.userData.id)
                         this.$root.$emit('bookmark-delete', removeBookmark)
                     })
                } else if(this.bookmarked == false){
                    axios.post('/bookmarks', {
                        post_id: this.postData.id,
                        user_id: this.userData.id
                    })
                    .then(response => {
                        this.$el.classList.remove('unbookmarked')
                        this.$el.classList.add('bookmarked')
                        this.bookmarked = true
                        this.bookmarks.push(response.data.bookmark)
                        this.$root.$emit('flash', 'Post saved!')
                        this.$root.$emit('bookmark-create', response.data.bookmark)
                    })
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .bookmarked {
        animation: .3s bookmark ease forwards;
        color: rgba(230, 149, 0, 1);
    }

    @keyframes bookmark{
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .unbookmarked {
        animation: .3s unbookmark ease forwards;
    }

    @keyframes unbookmark{
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }
</style>