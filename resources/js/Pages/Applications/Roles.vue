<template>
    <app-layout>
        <template #header>
            <button  type="button" class="btn btn-primary font-semibold text-xl text-gray-800 leading-tight" @click="view_permissions">
                Crear Rol
            </button>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table" >
                        <template>
                            <thead>
                            <tr>
                                <th class="text-left">
                                    id
                                </th>
                                <th class="text-left">
                                    Nombre Rol
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in roles_array">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                            </tr>
                            </tbody>
                        </template>
                    </table>
                </div>
            </div>
        </div>

        <div class="py-12">
            <jet-dialog-modal :show="isOpenModal" @close="closeReportsModal" max-width=xl>
                <template #title>
                    <label > Crear Rol</label>
                </template>

                <template #content v-if="modalData">
                    <div class="p-5">
                        <div class="gap-6">
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                    Nombre Rol
                                </label>
                                <div>
                                    <input  class="form-control" v-model="modalData.name" label="Another input">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template #footer>
                    <button @click="save(modalData)">
                        Guardar
                    </button>
                </template>
            </jet-dialog-modal>
        </div>
    </app-layout>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal";
import AppLayout from '@/Layouts/AppLayout'
import Button from "../../Jetstream/Button";

export default {
    components: {
        Button,
        AppLayout,
        JetDialogModal
    },

    props:{
        roles: Array,
    },

    data(){
        return{
            roles_array: this.roles,
            modalData: null,
            isOpenModal: false
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
            axios.post(route('save_roles'), data).then(resp => {
                this.closeReportsModal();
                this.roles_array = resp.data
            }).catch(error => {
                if (error.response.status === 422) {
                    alert('Error')
                }
            })
        },
    }
}
</script>
