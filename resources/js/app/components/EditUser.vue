
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

            returnValue(){
                this.newName = this.$refs.userName.innerText
            },

            saveValue(){
                if(this.newName == ''){
                    return
                } else {
                    this.name = this.newName
                    axios.patch(`/users/${this.userData.id}`, {name: this.newName})
                         .then(response => {
                             console.log(response.data)
                             this.$root.$emit('edit-message', 'Changes saved')
                         })
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    
</style>