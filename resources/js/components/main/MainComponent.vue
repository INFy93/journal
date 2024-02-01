<template>
    <header-title>
        Журнал
    </header-title>
    <div class="p-5 bg-gray-100 rounded-xl">
        <div class="flex flex-wrap md:flex-nowrap md:space-x-3">
            <div v-if="cities"
                class="right-0 flex items-center w-full h-10 max-w-xl p-2 mb-2 bg-white border border-gray-200 rounded shadow-sm">
                <svg class="w-5 h-5 text-gray-500 cursor-pointer" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" v-model="search" name="" id="" placeholder="Поиск по нас. пунктам"
                    class="w-full pl-3 text-sm text-black bg-transparent border-transparent border-none focus:border-transparent focus:outline-none focus:ring-0" />
            </div>

        </div>

        <table class="w-full mt-3">
            <thead class="border-b-2 border-gray-200 bg-gray-50">
                <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left ">Нас. пункт</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Узлы</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Оборудование</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left ">Посл. задача</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left w-60">Что сделано</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left w-60">Расходники</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <template v-for="city in cities" :key="city.id">
                    <tr class="bg-white" v-for="(node, key) in city.nodes" :key="node.id" v-if="cities">
                        <td v-if="key == 0" class="p-3 text-sm text-gray-700 whitespace-nowrap"
                            :rowspan="Object.keys(city.nodes).length"><span class="font-bold">{{
                                city.city_name }}</span></td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <router-link :to="{ name: 'tasks.index', params: { id: node.id } }"
                                class="font-bold text-blue-500 hover:underline">{{ node.node_name }}</router-link>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{
                            city.stuffs[key] === undefined ? 'Нет оборудования' : city.stuffs[key].stuff }}
                            <div class="flex flex-row space-x-1" v-if="city.stuffs[key] !== undefined">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ formatDate(city.stuffs[key].updated_at) }}</span>
                                <router-link :to="{ name: 'node.add.stuff', params: { id: node.id } }"
                                    class="font-bold text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </router-link>
                            </div>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <span v-if="city.records[key] !== undefined">
                                {{ city.records[key].node_id === node.id && city.records[key].goals !== null &&
                                    city.records[key].goals !== '' ?
                                    city.records[key].goals : '-' }}
                                <span class="flex flex-row space-x-1">
                                    <a href="#">+ Добавить задачу</a>
                                </span>
                            </span>
                            <span v-else>
                                -
                            </span>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><span
                                v-if="city.records[key] !== undefined">
                                {{ city.records[key].node_id === node.id ? city.records[key].task : '-' }}

                            </span>
                            <span v-else>
                                -
                            </span>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <span v-if="city.records[key] !== undefined">
                                {{ city.records[key].node_id === node.id && city.records[key].consumables !== null &&
                                    city.records[key].consumables !== '' ?
                                    city.records[key].consumables : '-' }}
                            </span>
                            <span v-else>
                                -
                            </span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <div class="hidden w-full mt-4 overflow-auto md:block">
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-semibold">Внимание!</span> Нет записей по данной выборке.
        </div>
    </div>
    <div>
    </div>
</template>
<script>
import { onMounted, watch } from 'vue';
import useCities from '../../composables/cities/cities';
import useHelpers from '../../composables/helpers/helper';
export default {
    setup() {
        const { getCities, cities, search } = useCities();
        const { formatDate } = useHelpers();

        onMounted(async () => {
            await getCities();
        })

        watch(search, async () => {
            await getCities();
        })

        return {
            cities,
            search,
            formatDate
        }
    }
}

</script>
