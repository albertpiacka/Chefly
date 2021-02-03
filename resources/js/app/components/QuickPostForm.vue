<template>
    <div>
        <textarea name="quickpost" id="quickpost" rows="3" placeholder="What's on your mind?"
        v-model="quickpost"
        ></textarea>

        <input @change="setImg" type="file" ref="fileInput" class="file-input" hidden>

        <div class="controls-wrap">
            <button @click="sendPost" class="button-primary-light">Post it</button>
            <b-icon @click="loadImg" icon="image-fill"></b-icon>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                quickpost: '',
                image: '',
            }
        },

        methods: {
            sendPost() {
                let data = {
                    user_id: this.user.id,
                    text: this.quickpost,
                    image: this.image,
                }

                axios.post('/quickposts', data)
                     .then(response => {
                         this.$root.$emit('flash', response.data.message)
                         this.$root.$emit('new-quickpost', response.data.quickpost)
                     })

                this.quickpost = ''
            },

            loadImg(){
                this.$refs.fileInput.click()
            },

            setImg(e){
                let image = this.$refs.fileInput
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload = (e) => {
                    image.src = e.target.result
                    this.image = e.target.result
                }
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>