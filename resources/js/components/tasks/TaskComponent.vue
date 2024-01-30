<template>
    <header-title>
        Задачи по узлу
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
        <table v-else class="w-full mt-3">
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
                <tr class="bg-white" v-for="record in records">
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
</template>

<script>
import { onMounted, ref, watch } from "vue";
import { TailwindPagination } from 'laravel-vue-pagination';
import useRecords from "../../composables/records/records";
import useHelpers from "../../composables/helpers/helper";
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

        onMounted(async () => {
            await getAllRecordsByNode(props.id);
        })

        return {
            records,
            formatDate
        }
    }
}
</script>

