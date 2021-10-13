<template>
    <app-layout>
        <template #header>
            <button  type="button" class="btn btn-primary font-semibold text-xl text-gray-800 leading-tight" @click="view_permissions">
                Crear Permiso
            </button>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>
            </div>
        </div>


        <div class="py-12">
            <jet-dialog-modal :show="isOpenModal" @close="closeReportsModal" max-width=xl>
                <template #title>
                    <label > Crear Permiso</label>
                </template>

                <template #content v-if="modalData">
                    <div class="p-5">
                        <div class="gap-6">
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                    Nombre Permiso
                                </label>
                                <div>
                                    <v-text-field v-model="modalData.name" label="Another input"></v-text-field>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template #footer>
                    <v-btn
                        color="secondary"
                        elevation="2"
                        large
                        @click="save(modalData)"
                    >Guardar</v-btn>
                </template>
            </jet-dialog-modal>
        </div>
    </app-layout>

</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal";
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'

export default {
    components: {
            AppLayout,
            Welcome,
        JetDialogModal
    },

    props: {
        permisos: Array
    },

    data(){
      return{
          isOpenModal: false,
          modalData: null,
      }
    },


    methods:{
        view_permissions(row){
            this.isOpenModal = true
            this.modalData = row
        },

        closeReportsModal(){
            this.isOpenModal = false
        },

        save(data) {
            axios.post(route('save_permissions'), data).then(resp => {
                this.closeReportsModal();
                data = resp.data
            }).catch(error => {
                if (error.response.status === 422) {
                   alert('Error')
                }
            })
        },
    }
}
</script>
