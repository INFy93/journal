<template>
    <header-title>Работа с устройствами</header-title>
    <div class="flex flex-wrap md:flex-nowrap md:space-x-3">
        <div class="w-full mt-2 mb-6 md:w-1/3 md:mb-0">
            <h4 class="flex text-xl font-extrabold tracking-tight text-gray-800 sm:text-xl dark:text-white">
                Город/село
            </h4>
            <updateCity ref="changeCity" @updateCities="getCities"></updateCity>
            <updateNode ref="changeNode" @updateNodes="getNode"></updateNode>
            <updateDevice ref="changeDevice" @updateDevice="getDev"></updateDevice>
            <div class="mt-3">
                <div class="flex space-x-1 justify-items-center" v-for="city in cities" :key="city.id">
                    <span class="cursor-pointer" @click="getNode(city.id)">{{ city.city_name }}</span>
                    <svg @click="editCity(city.id)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>

                </div>
            </div>
            <div v-if="errors">
                <div v-for="(v, k) in errors" :key="k"
                    class="w-full px-3 py-2 pr-0 mb-6 font-bold text-white bg-red-500 rounded shadow-lg">
                    <p v-for="error in v" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700" for="name">Населенный пункт</label>
                <div class="mt-1">
                    <input id="name" v-model="city.city_name"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="name" type="text" />
                </div>
            </div>
            <button
                class="inline-flex items-center px-4 py-2 mt-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                type="submit" @click="saveCity">
                Добавить
            </button>
        </div>
        <div v-if="Object.keys(nodes).length || cityId" class="w-full mt-2 mb-6 md:w-1/3 md:mb-0">
            <h4 class="flex text-xl font-extrabold tracking-tight text-gray-800 sm:text-xl dark:text-white">
                Точки/ноды
            </h4>
            <div class="mt-3">
                <div class="flex space-x-1 justify-items-center" v-for="s_node in nodes" :key="s_node.id">
                    <span class="cursor-pointer" @click="getDev(s_node.id)">{{ s_node.node_name }}</span>
                    <svg @click="editNode(s_node.id)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </div>
            </div>
            <div v-if="nodes_errors">
                <div v-for="(v, k) in nodes_errors" :key="k"
                    class="w-2/3 px-3 py-2 pr-0 mb-6 font-bold text-white bg-red-500 rounded shadow-lg">
                    <p v-for="error in v" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700" for="name">Новый узел</label>
                <div class="mt-1">
                    <input id="name" v-model="node.node_name"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="name" type="text" />
                </div>
                <button
                    class="inline-flex items-center px-4 py-2 mt-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                    type="submit" @click="saveNode(cityId)">
                    Добавить
                </button>
            </div>

        </div>
        <div v-if="Object.keys(device).length || deviceId" class="w-full mt-2 mb-6 md:w-1/3 md:mb-0">
            <h4 class="flex text-xl font-extrabold tracking-tight text-gray-800 sm:text-xl dark:text-white">
                Устройства
            </h4>
            <div class="mt-3">
                <div class="flex space-x-1 justify-items-center" v-for="device in devices" :key="device.id">
                    <span class="cursor-pointer">{{ device.device_name }}</span>
                    <svg @click="editDevice(device.id)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </div>
            </div>
            <div v-if="deviceErrors">
                <div v-for="(v, k) in deviceErrors" :key="k"
                    class="w-2/3 px-3 py-2 pr-0 font-bold text-white bg-red-500 rounded shadow-lg">
                    <p v-for="error in v" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700" for="name">Новое устройство</label>
                <div class="mt-1">
                    <input id="name" v-model="n_device.device_name"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="name" type="text" />
                </div>
                <button
                    class="inline-flex items-center px-4 py-2 mt-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                    type="submit" @click="saveDevice(deviceId)">
                    Добавить
                </button>
            </div>

        </div>
    </div>
</template>

<script>
import useCities from "../../../composables/cities/cities.js";
import useNodes from "../../../composables/nodes/nodes.js";
import useDevice from "../../../composables/devices/device.js";
import { onMounted, reactive, ref } from "vue";



export default {
    setup() {
        const { cities, errors, storeCity, getCities } = useCities();
        const { nodes, nodes_errors, cityId, storeNodes, getNodes } = useNodes();
        const { getDevices, storeDevice, deviceErrors, device, devices, deviceId } = useDevice();

        const changeCity = ref(null);
        const changeNode = ref(null);
        const changeDevice = ref(null);

        const editCity = async (id) => {
            await changeCity.value.openCityEditDialog(id)
        }

        const editNode = async (id) => {
            await changeNode.value.openNodeEditDialog(id)
        }

        const editDevice = async (id) => {
            await changeDevice.value.openDeviceEditDialog(id)
        }

        const city = reactive({
            city_name: ''
        })

        const node = reactive({
            city_id: '',
            node_name: ''
        })

        const n_device = reactive({
            node_id: '',
            device_name: ''
        })

        onMounted(() => {
            getCities();
        })

        const getNode = async (id) => {
            await getNodes(id);
            node.city_id = id;
            if (Object.keys(devices).length) {
                devices.value = [''];
                deviceId.value = '';
            }
        }

        const getDev = async (id) => {
            await getDevices(id);
            n_device.node_id = id;
        }

        const saveCity = async () => {
            await storeCity({ ...city });
            await getCities();
            city.city_name = '';
        }

        const saveNode = async (id) => {
            await storeNodes({ ...node });
            await getNodes(id);
            node.node_name = '';
        }

        const saveDevice = async (id) => {
            await storeDevice({ ...n_device });
            await getDevices(id);
            n_device.device_name = '';
        }

        return {
            cities,
            city,
            errors,
            nodes,
            node,
            cityId,
            nodes_errors,
            device,
            devices,
            n_device,
            deviceId,
            deviceErrors,
            changeCity,
            changeNode,
            changeDevice,
            getCities,
            editCity,
            editNode,
            editDevice,
            saveDevice,
            getDev,
            saveNode,
            getNode,
            saveCity
        }
    }
}
</script>
