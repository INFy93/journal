<template>
    <header-title>
        Журнал
    </header-title>
    <div class="p-5 bg-gray-100 rounded-xl">
        <div class="flex flex-wrap md:flex-nowrap md:space-x-3">
            <div class="w-full mb-6 md:w-1/3 md:mb-0">
                <select name="period" id="period"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option disabled value="">Выберите город</option>
                    <option v-for="city in cities" :key="city.id" :value="city.id" @click="getNode(city.id)">{{
                        city.city_name }}</option>
                </select>
            </div>
            <div class="w-full mb-6 md:w-1/3 md:mb-0" v-if="Object.keys(nodes).length">
                <select name="period" id="period" v-model="selectedNode"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option disabled value="">Выберите узел</option>
                    <option v-for="node in nodes" :key="node.id" :value="node.id" @click="nodeName = node.node_name">{{
                        node.node_name }}</option>
                </select>
            </div>

        </div>
        <div v-if="!Object.keys(records).length && !emptyFilter">
            <img src="/storage/img/load_table.svg" style="margin: 0 auto" />
        </div>
        <div v-else class="hidden overflow-auto md:block">
            <div class="flex space-x-2">
                <router-link :to="{ name: 'tasks.add', params: { id: selectedNode, node: nodeName } }" v-if="selectedNode"
                    class="update-button">
                    <button
                        class="flex items-center justify-center px-4 py-2 mt-4 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 dark:bg-blue-900 dark:hover:bg-blue-700">
                        <span class="hidden bg-blue-500 normal"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Запись ({{ nodeName }})</span>
                    </button>
                </router-link>
                <div v-if="selectedNode">

                    <button @click.prevent="resetFilter"
                        class="flex items-center justify-center px-4 py-2 mt-4 font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-900 dark:hover:bg-blue-700">
                        <span class="hidden bg-blue-500 normal"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                        <span>Сбросить фильтр</span>
                    </button>
                </div>
            </div>
            <table class="w-full mt-3">
                <thead class="border-b-2 border-gray-200 bg-gray-50">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left ">Узел</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Устройство</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Дата</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left ">Задача</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-60">Что сделано</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-60">Расходники</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr :class="[record.goals ? 'bg-green-200' : 'bg-white']" v-for="record in  records.data "
                        :key="record.id">
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <router-link :to="{ name: 'task.edit', params: { id: record.id, node: record.nodes.id } }"
                                class="font-bold text-blue-500 hover:underline">{{ record.cities.city_name }}, {{
                                    record.nodes.node_name }}</router-link>

                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <router-link :to="{ name: 'device.add.stuff', params: { id: record.devices.id } }"
                                class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-300 rounded-lg bg-opacity-50">{{
                                    record.devices.device_name }}</router-link>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            {{ formatDate(record.updated_at) }}
                            ({{ formatDate(record.updated_at, "LT") }})
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.goals }}</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.task }}</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.consumables }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="emptyFilter" class="hidden w-full mt-4 overflow-auto md:block">
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-semibold">Внимание!</span> Нет записей по данной выборке.
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:hidden">
            <div v-if="emptyFilter" class="w-full mt-4 overflow-auto md:block">
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-semibold">Внимание!</span> Нет записей по данной выборке.
                </div>
            </div>
            <div class="flex space-x-2">
                <router-link :to="{ name: 'tasks.add', params: { id: selectedNode } }" v-if="selectedNode"
                    class="update-button">
                    <button
                        class="flex items-center justify-center px-4 py-2 mb-1 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 dark:bg-blue-900 dark:hover:bg-blue-700">
                        <span class="hidden bg-blue-500 normal"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Запись ({{ nodeName }})</span>
                    </button>
                </router-link>
                <div v-if="selectedNode">

                    <button @click.prevent="resetFilter"
                        class="flex items-center justify-center px-4 py-2 font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-900 dark:hover:bg-blue-700">
                        <span class="hidden bg-blue-500 normal"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                        <span>Сбросить фильтр</span>
                    </button>
                </div>
            </div>
            <div class="p-4 space-y-3 bg-white rounded-lg shadow" v-for=" record  in  records.data " :key="record.id">
                <div class="flex items-center space-x-2 text-sm">
                    <div>
                        <router-link :to="{ name: 'task.edit', params: { id: record.id, node: record.nodes.id } }"
                            class="font-bold text-blue-500 hover:underline">{{ record.nodes.node_name }}</router-link> ({{
                                record.cities.city_name }})
                    </div>
                    <div class="text-gray-500">{{ formatDate(record.created_at) }}</div>

                </div>
                <div>
                    <span
                        class="text-xs font-medium tracking-wider text-green-800 uppercase bg-green-200 bg-opacity-50 rounded-lg">{{
                            record.devices.device_name }}</span>
                </div>
                <div class="text-sm text-gray-700"> {{ record.task }} </div>
                <div class="text-sm font-medium text-black"> {{ record.users.name }} </div>
                <div class="text-sm italic text-gray-700"> {{ record.consumables }} </div>

            </div>
        </div>
    </div>
    <div>
        <TailwindPagination :data="records" :limit="4" @pagination-change-page="getAllRecords" class="mt-3" />
    </div>
</template>

<script>
import useRecords from "../../composables/records/records.js";
import useCities from "../../composables/cities/cities.js";
import useHelpers from "../../composables/helpers/helper.js";
import useNodes from "../../composables/nodes/nodes.js";
import useDevice from "../../composables/devices/device.js";
import { onMounted, ref, watch } from "vue";
import { TailwindPagination } from 'laravel-vue-pagination';
export default {
    setup() {
        const { records, selectedDevice, selectedNode, getAllRecords } = useRecords();
        const { nodes, getNodes } = useNodes();
        const { cities, getCities } = useCities()
        const { formatDate } = useHelpers();
        const { device, getDevice } = useDevice();

        const emptyFilter = ref(false);
        const nodeName = ref('');

        onMounted(() => {
            getAllRecords();
            getCities();
        })

        const getNode = async (id) => {
            await getNodes(id)
        }



        watch(selectedNode, async () => {
            await getAllRecords();
            emptyFilter.value = !Object.keys(records.value).length;
        })

        const resetFilter = async () => {
            selectedNode.value = '';
            nodes.value = [];
            await getAllRecords();
        }

        return {
            records,
            cities,
            nodes,
            nodeName,
            selectedNode,
            selectedDevice,
            emptyFilter,
            getDevice,
            getAllRecords,
            resetFilter,
            getNode,
            formatDate
        }
    }
}
</script>

