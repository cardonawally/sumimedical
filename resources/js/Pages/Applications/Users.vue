<template>
    <app-layout>
        <template #header>
            <button type="button"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                    @click="view_role">
                usuarios que tengan el rol 1 y 2.
            </button>
            <button type="button"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                    @click="permission">
                permisos que se tienen del rol 1
            </button>
            <button type="button"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                    @click="permission_role">
                usuarios y el rol que tienen el permiso 2
            </button>
        </template>

        <template v-if="queryResult">
            <div class="items-center text-center">
                <div class="bg-white border-transparent rounded-md relative w-4/5 mt-10 mx-auto">
                    <template v-if="queryResult.type === 'role'">
                        <table class="w-full text-center">
                            <thead>
                                <tr>
                                    <th colspan="2" class="font-medium px-5 py-3 border-b-2 col-span-2">
                                        Usuario con rol 1 y 2
                                    </th>
                                </tr>
                                <tr>
                                    <th class="font-medium px-5 py-3 border-b-2"> USUARIO </th>
                                    <th class="font-medium px-5 py-3 border-b-2"> ROL </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in queryResult.data">
                                    <td class="px-5 py-3 border-b-2">{{ user.name + ' ' +  user.last_name }}</td>
                                    <td class="px-5 py-3 border-b-2">{{ user.roles.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </template>

                    <template v-if="queryResult.type === 'permission'">
                        <table class="w-full text-center">
                            <thead>
                                <tr>
                                    <th colspan="2" class="font-medium px-5 py-3 border-b-2 col-span-2">
                                        Permisos asociados al rol 1
                                    </th>
                                </tr>
                                <tr>
                                    <th class="font-medium px-5 py-3 border-b-2"> PERMISO </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="permission in queryResult.data">
                                    <td class="px-5 py-3 border-b-2">{{ permission.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </template>

                    <template v-if="queryResult.type === 'permission_role'">
                        <table class="w-full text-center">
                            <thead>
                                <tr>
                                    <th colspan="2" class="font-medium px-5 py-3 border-b-2 col-span-2">
                                        Usuarios y rol que tienen el permiso 2
                                    </th>
                                </tr>
                                <tr>
                                    <th class="font-medium px-5 py-3 border-b-2"> ROL </th>
                                    <th class="font-medium px-5 py-3 border-b-2"> USUARIO </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rol_user in queryResult.data">
                                    <td class="px-5 py-3 border-b-2">{{ rol_user.rol }}</td>
                                    <td class="px-5 py-3 border-b-2">{{ rol_user.user }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                </div>
            </div>
        </template>

        <div class="items-center text-center">
            <div class="bg-white border-transparent rounded-md relative w-4/5 mt-10 mx-auto">
                <table class="w-full text-center">
                    <thead>
                        <tr>
                            <th class="font-medium px-5 py-3 border-b-2">
                                ID
                            </th>
                            <th class="font-medium px-5 py-3 border-b-2">
                                NOMBRE
                            </th>
                            <th class="font-medium px-5 py-3 border-b-2">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users_array">
                            <td class="px-5 py-3 border-b-2">{{ user.id }}</td>
                            <td class="px-5 py-3 border-b-2">{{ user.name + ' ' +  user.last_name }}</td>
                            <td class="px-5 py-3 border-b-2">
                                <button type="button" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" @click="view_permissions(user)">
                                    Actualizar Información de Usuarios
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <jet-dialog-modal :show="isOpenModal" @close="closeModal" max-width=xl>
            <template #title v-if="users_array">
                <label >Actualizar Usuarios</label>
            </template>

            <template #content v-if="modalData">
                <div class="p-5">
                    <div class="grid grid-col-2 gap-4">
                        <div class="mt-1">
                            <label class="flex flex-col sm:flex-row font-medium">
                               Nombres
                            </label>
                            <div>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="modalData.name">
                            </div>
                        </div>
                        <div class="mt-1">
                            <label class="flex flex-col sm:flex-row font-medium">
                                Apellidos
                            </label>
                            <div>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="modalData.last_name">
                            </div>
                        </div>
                        <div class="mt-1">
                            <label class="flex flex-col sm:flex-row font-medium">
                                Teléfono
                            </label>
                            <div>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="modalData.phone">
                            </div>
                        </div>
                        <div class="mt-1">
                            <label class="flex flex-col sm:flex-row font-medium">
                                Email
                            </label>
                            <div>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="modalData.email">
                            </div>
                        </div>
                        <div class="mt-1">
                            <label class="flex flex-col sm:flex-row font-medium">
                                Rol
                            </label>
                            <div>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="modalData.role_id">
                                    <option
                                        v-for="role in role_array"
                                        v-bind:key="role.id"
                                        :value="role.id">{{ role.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-1">
                            <label class="flex flex-col sm:flex-row font-medium">
                                Permisos Asociados
                            </label>
                            <div v-if="modalData.roles && modalData.roles.permissions">
                                <span class="mx-4" v-for="permission in modalData.roles.permissions"
                                      v-bind:key="permission.id">
                                    {{permission.name}}
                                </span>
                            </div>
                            <div v-else>
                                <span class="text-red-400">El usuario no tiene permisos asociados</span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template #footer>
                <button  type="button" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" @click="save(modalData)">
                    Guardar
                </button>

                <button type="button" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" @click="closeModal">
                    Cancelar
                </button>
            </template>
        </jet-dialog-modal>
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
        rol: Array,
    },

    data(){
        return{
            role_array: this.rol,
            users_array: this.users,
            modalData: null,
            isOpenModal: false,
            isOpen: false,
            role: [],
            queryResult: null
        }
    },

    methods:{
        view_permissions(row){
            this.isOpenModal = true
            this.modalData = row
        },

        closeModal(){
            this.isOpenModal = false
        },

        save(data) {
            axios.post(route('users.store'), data).then(resp => {
                this.closeModal();
                this.users_array = resp.data
            }).catch(error => {
                if (error.response.status === 422) {
                    alert('Error')
                }
            })
        },

        view_role(){
            axios.get(route('queries.role')).then(resp => {
                this.queryResult = {
                    data: resp.data,
                    type: 'role'
                }
            }).catch(err => {
                alert(err.data)
            })
        },

        permission(){
            axios.get(route('queries.permission')).then(resp => {
                this.queryResult = {
                    data: resp.data,
                    type: 'permission'
                }
            }).catch(err => {
                alert(err.data)
            })
        },

        permission_role(){
            axios.get(route('queries.permission-role')).then(resp => {
                this.queryResult = {
                    data: resp.data,
                    type: 'permission_role'
                }
            }).catch(err => {
                alert(err.data)
            })
        }
    }
}
</script>
