
<script>
    export default {
        props: ['post-data'],

        data() {
            return {
                text: '',
                userId: '',
                postId: '',
                userName: '',
                date: ''
            }
        },

        mounted () {
            this.postId = this.$refs.postId.value,
            this.userId = this.$refs.userId.value,
            this.userName = this.$refs.userName.value,
            this.date = momentJs().fromNow()
        },

        methods: {
            returnData() {
                axios.post('/comments', {
                    post_id: this.postId,
                    user_id: this.userId,
                    text: this.text
                })
                .then(response => {
                    this.$root.$emit('comment-message', response.data.message)
                    
                    this.$root.$emit('comment', {
                        'text': response.data.comment.text,
                        'id': response.data.comment.user_id,
                        'user': {
                            'name': this.userName
                        }
                    });
                });

                // this.$root.$emit('comment', {
                //         'text': this.text,
                //         'id': Math.floor(Math.random() * Math.floor(1000)),
                //         'user': {
                //             'name': this.userName
                //         }
                // });

                this.$refs.textArea.value = ''
            }
        },
    }
</script>

