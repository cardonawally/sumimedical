<template>
    <app-layout>
        <div>
            <div class="intro-y box">
                <table class="table text-center" >
                    <thead>
                        <tr class="border-b-2 dark:border-dark-5">
                            <th class="border-b-2 dark:border-dark-5">
                                ID
                            </th>
                            <th class="border-b-2 dark:border-dark-5">
                                Nombre Rol
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in users_array">
                            <td class="border-b-2 dark:border-dark-5">{{ item.id }}</td>
                            <td class="border-b-2 dark:border-dark-5">{{ item.name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary font-semibold text-xl text-gray-800 leading-tight" @click="view_permissions(item)">
                                    Actualizar Información de Usuarios
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="py-12">
            <jet-dialog-modal :show="isOpenModal" @close="closeReportsModal" max-width=xl>
                <template #title v-if="users_array">
                    <label >Actualizar Usuarios</label>
                </template>

                <template #content v-if="modalData">
                    <div class="p-5">
                        <div class="gap-6">
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                   Nombre Usuario
                                </label>
                                <div>
                                    <input class="form-control border border-b-2 dark:border-dark-5" v-model="modalData.name">
                                </div>
                            </div>
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                    Apellido
                                </label>
                                <div>
                                    <input class="form-control border border-b-2 dark:border-dark-5" v-model="modalData.last_name">
                                </div>
                            </div>
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                    Telefono
                                </label>
                                <div>
                                    <input class="form-control border border-b-2 dark:border-dark-5" v-model="modalData.phone">
                                </div>
                            </div>
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                    Email
                                </label>
                                <div>
                                    <input class="form-control border border-b-2 dark:border-dark-5" v-model="modalData.email">
                                </div>
                            </div>
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                    Rol
                                </label>
                                <div>
                                    <select class="form-select" v-model="modalData.role_id">
                                        <option
                                            v-for="works in role_array"
                                            v-bind:key="works.id"
                                            :value="works.id">{{works.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-1">
                                <label class="flex flex-col sm:flex-row font-medium">
                                    Permisos Asociados
                                </label>
                                <div>
                                    <span class="mx-4"  v-for="permission in modalData.roles.permissions"
                                          v-bind:key="permission.id">
                                        {{permission.name}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template #footer>
                    <button  type="button" class="btn btn-primary" @click="save(modalData)">
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
import Welcome from '@/Jetstream/Welcome'

export default {
    components: {
        AppLayout,
        Welcome,
        JetDialogModal
    },

    props:{
        users: Array,
        rol: Array
    },

    data(){
        return{
            role_array: this.rol,
            users_array: this.users,
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
            axios.post(route('save_users'), data).then(resp => {
                this.closeReportsModal();
                this.users_array = resp.data
            }).catch(error => {
                if (error.response.status === 422) {
                    alert('Error')
                }
            })
        },
    }
}
</script>
