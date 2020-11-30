
<script>
    export default {
        props: ['user-data'],
        data() {
            return {
                editing: false,
                text: 'Edit profile',
                name: '',
                newName: '',
            }
        },    
        
        mounted () {
            this.name = this.userData.name
        },

        methods: {
            startEditing() {
                if(this.editing == false){
                    this.editing = true
                    this.text = 'Editing'
                } else if(this.editing == true){
                    this.editing = false
                    this.text = 'Edit profile'
                }
            },

            returnValue(){
                this.newName = this.$refs.userName.innerText
            },

            saveValue(){
                this.name = this.newName
            }
        },
    }
</script>

<style lang="scss" scoped>
    
</style>