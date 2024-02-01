<template>
    <header-title>
        Задачи по узлу {{ node.node_name }}
    </header-title>
    <div class="p-5 bg-gray-100 rounded-xl">
        <div class="flex flex-wrap md:flex-nowrap md:space-x-3">


        </div>
        <div v-if="!Object.keys(records).length">
            <div class="hidden w-full mt-4 overflow-auto md:block">
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-semibold">Внимание!</span> Нет записей по данной выборке.
                </div>
            </div>
        </div>
        <div v-else>
            <div class="flex space-x-2" v-if="node.id">
                <router-link :to="{ name: 'tasks.add', params: { id: node.id, node: node.node_name } }"
                    class="update-button">
                    <button
                        class="flex items-center justify-center px-4 py-2 mt-2 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 dark:bg-blue-900 dark:hover:bg-blue-700">
                        <span class="hidden bg-blue-500 normal"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Добавить запись</span>
                    </button>
                </router-link>
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
                    <tr class="bg-white" v-for="record in records.data">
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.nodes.node_name }}</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.devices.device_name }}</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ formatDate(record.created_at) }}</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.goals }}</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.task }}</td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ record.consumables }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { onMounted, ref, watch } from "vue";
import useRecords from "../../composables/records/records";
import useHelpers from "../../composables/helpers/helper";
import useNodes from "../../composables/nodes/nodes";
export default {
    props: {
        id: {
            required: true,
            type: String
        },
    },

    setup(props) {

        const { getAllRecordsByNode, records } = useRecords();
        const { formatDate } = useHelpers();
        const { getSingleNode, node } = useNodes();

        onMounted(async () => {
            await getAllRecordsByNode(props.id);
            await getSingleNode(props.id);
        })

        return {
            records,
            node,
            formatDate
        }
    }
}
</script>

