<template>
    <app-layout>
        <template #header>
            <button type="button"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                    @click="view_permissions">
                Crear Permiso
            </button>
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
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in permisos_array">
                        <td class="px-5 py-3 border-b-2">{{ item.id }}</td>
                        <td class="px-5 py-3 border-b-2">{{ item.name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <jet-dialog-modal :show="isOpenModal" @close="closeModal" max-width=xl>
            <template #title>
                <label> Crear Permiso</label>
            </template>

            <template #content v-if="modalData">
                <div class="p-5">
                    <div class="gap-6">
                        <div class="mt-1">
                            <label class="flex flex-col sm:flex-row font-medium">
                                Nombre Permiso
                            </label>
                            <div>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       v-model="modalData.name">
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template #footer>
                <button type="button" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" @click="save(modalData)">
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
import Button from "../../Jetstream/Button";
import Input from "../../Jetstream/Input";

export default {
    components: {
        Input,
        Button,
        AppLayout,
        Welcome,
        JetDialogModal
    },

    props: {
        permisos: Array
    },

    data() {
        return {
            permisos_array: this.permisos,

            isOpenModal: false,
            modalData: null,
        }
    },


    methods: {
        view_permissions(row) {
            this.isOpenModal = true
            this.modalData = row
        },

        closeModal() {
            this.isOpenModal = false
        },

        save(data) {
            axios.post(route('permissions.store'), data).then(resp => {
                this.closeModal();
                this.permisos_array = resp.data
            }).catch(error => {
                if (error.response.status === 422) {
                    alert('Error')
                }
            })
        },
    }
}
</script>
