<template>
    <header-title>
        Добавить запись. Узел: {{ node.node_name }}
    </header-title>
    <div class="mt-4 text-gray-900 dark:text-gray-100">
        <div v-if="errors">
            <div v-for="(v, k) in errors" :key="k"
                class="w-full px-3 py-2 pr-0 font-bold text-white bg-red-500 rounded shadow-lg md:w-1/3">
                <p v-for="error in v" :key="error" class="text-sm">
                    {{ error }}
                </p>
            </div>
        </div>

        <form class="space-y-6" v-on:submit.prevent="saveRecord">
            <div class="flex flex-wrap mb-6 -mx-3">
                <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                    <label for="devices" class="block text-sm font-medium text-gray-700">Устройство*</label>
                    <select name="devices" id="devices" v-model="form.device_id" v-on:change="getStuff($event.target.value)"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option disabled value="" selected>Выберите устройство</option>
                        <option v-for="device in devices" :key="device.id" :value="device.id">
                            {{
                                device.device_name }}
                        </option>
                    </select>
                </div>
                <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                    <label for="time" class="block text-sm font-medium text-gray-700">Выберите пользователя*</label>
                    <select name="users" id="users" v-model="form.user_id"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option disabled value="">Выберите пользователя</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                    </select>
                </div>
                <div class="w-full px-3 mt-4 mb-6 md:w-2/3 md:mb-0">
                    <h3 class="text-xl font-bold">Оборудование на устройстве</h3>
                    <textarea v-model="stuff.stuff" id="message" rows="4"
                        class="block  mt-1 mb-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Выберите устройство для отображения оборудования"></textarea>
                    <button @click.prevent="saveStuff(stuff.id)" v-if="Object.keys(stuff).length"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
                        {{ isEmpty ? 'Добавить' : 'Обновить' }}
                    </button>
                </div>

                <div class="w-full px-3 mt-2 mb-6 md:w-2/3 md:mb-0">
                    <h3 class="mt-3 text-xl font-bold">Новая запись</h3>
                    <label for="time" class="block mt-2 text-sm font-medium text-gray-700">Задача*</label>
                    <textarea v-model="form.goals" id="message" rows="4"
                        class="block  mt-1 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Планируемые работы..."></textarea>

                </div>
                <div class="w-full px-3 mt-2 mb-6 md:w-2/3 md:mb-0">
                    <label for="time" class="block text-sm font-medium text-gray-700">Что сделано*</label>
                    <textarea v-model="form.task" id="message" rows="4"
                        class="block  mt-1 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Описание работ..."></textarea>

                </div>
                <div class="w-full px-3 mt-2 mb-6 md:w-2/3 md:mb-0">
                    <label for="time" class="block text-sm font-medium text-gray-700">Расходные материалы</label>
                    <textarea v-model="form.consumables" id="message" rows="4"
                        class="block  mt-1 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Необязательно"></textarea>

                </div>
            </div>
            <div class="flex space-x-2">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
                    Добавить
                </button>
                <router-link :to="{ name: 'tasks.index' }"
                    class="inline-flex items-center px-4 py-2 space-x-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
                    Вернуться
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
import useRecords from "../../composables/records/records.js";
import useDevice from "../../composables/devices/device.js";
import useUsers from "../../composables/users/users.js";
import useNodes from "../../composables/nodes/nodes.js";
import { onMounted, reactive, watch } from "vue";

export default {
    props: {
        id: {
            required: true,
            type: Number
        },
        node: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { storeRecord, errors } = useRecords()
        const { devices, getDevices } = useDevice()
        const { users, currentUser, getUsers } = useUsers()
        const { node, getSingleNode } = useNodes()
        const { getStuff, storeStuff, stuff, isEmpty } = useDevice();

        const form = reactive({
            node_id: props.id,
            device_id: '',
            user_id: '',
            goals: '',
            task: '',
            consumables: ''
        })

        onMounted(async () => {
            await getDevices(props.id);
            await getSingleNode(props.id);
            await getUsers();
        })

        const saveRecord = async () => {
            await storeRecord({ ...form });
        };

        const saveStuff = async (id) => {
            await storeStuff(id, { ...stuff.value })
        }

        return {
            devices,
            node,
            errors,
            users,
            form,
            stuff,
            isEmpty,
            currentUser,
            getStuff,
            saveStuff,
            saveRecord
        }
    }
}

</script>
