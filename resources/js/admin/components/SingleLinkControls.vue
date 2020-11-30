<template>
    <div class="single-link-controls">
        <router-link to="/admin/new-post">
            <button v-if="this.resource == 'post'" class="new-button my-buttons">
                New {{this.resource}}
            </button>
        </router-link>

        <router-link :to="`/admin/${resource}s/${id}/edit`">
            <button class="edit-button my-buttons">
                Edit {{this.resource}}
            </button>
        </router-link>

        <button v-b-modal.modal-1 class="delete-button my-buttons">
            Delete {{this.resource}}
        </button>

        <b-modal id="modal-1" hide-footer>
            <template #modal-title>
                <div class="text-dark">
                    Are you sure you want to delete this?
                </div>
            </template>
            <b-button class="mt-3" @click="$bvModal.hide('modal-1'), deleteResource()">Delete</b-button>
            <b-button class="mt-3" @click="$bvModal.hide('modal-1')">Cancel</b-button>
        </b-modal>
    </div>
</template>

<script>
    export default {
        props: ['resource', 'id'],

        methods: {
            deleteResource() {
                axios.delete(`/api/${this.resource}s/${this.id}`)
                     .then(response => {
                         this.$router.push(`/admin/${this.resource}s`)
                     })
                     .catch(err => {
                         this.$bvToast.toast(`${err.response.data.message}`, {
                                variant: 'warning',
                                solid: true
                            })
                     })
            }
        },
        
    }
</script>

<style lang="scss" scoped>
    .my-buttons {
        @media (max-width: 500px){
            width: 100%;
            display: block;
            margin: .3em 0;
        }

        &:focus {
            outline: none;
        }
    }

    .new-button {
        background: #03A65A;
        &:hover {
            background: #44BF4D;
        }
    }

    .edit-button {
        background: transparent;
    }

    .delete-button {
        background: #BF3111;
        &:hover {
            background: #BF4439;
        }
    }
</style>