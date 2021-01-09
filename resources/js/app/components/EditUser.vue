
<script>
    export default {
        props: ['user-data'],
        data() {
            return {
                editing: false,
                text: 'Edit profile',
                name: '',
                newName: '',
                about: '',
                newAbout: '',
                oldImg: '',
                image: ''
            }
        },    
        
        mounted () {
            this.name = this.userData.name
            this.oldImg = this.userData.image
            this.about = this.userData.about
        },

        methods: {
            toggleEditing() {
                if(this.editing == false){
                    this.editing = true
                    this.text = 'Save'
                } else if(this.editing == true){
                    this.editing = false
                    this.text = 'Edit profile'
                    this.saveValue()
                }
            },

            returnName(){
                this.newName = this.$refs.userName.innerText
            },

            returnAbout(){
                this.newAbout = this.$refs.aboutMe.innerText
            },

            setImg(e){
                let userImg = this.$refs.userImg
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload = (e) => {
                    userImg.src = e.target.result
                    this.image = e.target.result
                }
            },

            saveValue(){
                let data = {
                    name: this.newName,
                    about: this.newAbout,
                    oldImg: this.oldImg,
                    file: this.image,
                }

                axios.patch(`/users/${this.userData.id}`, data)
                        .then(response => {
                            this.oldImg = response.data
                            this.$root.$emit('flash', 'Changes saved')
                        })
            }
        },

        watch: {
            name(oldVal) {
                this.newName = oldVal
            },

            about(oldVal) {
                this.newAbout = oldVal
            },
        },
    }
</script>

<style lang="scss" scoped>
    .editing{
        border: 1px solid #fff;
        padding: .3em;
        border-radius: 1em;
    }
</style>