<template>
    <header-title>
        Редактировать оборудование на узле
    </header-title>
    <div class="w-full px-3 mt-4 mb-6 md:w-2/3 md:mb-0">
        <textarea v-model="stuff.stuff" id="message" rows="4"
            class="block  mt-1 mb-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Выберите устройство для отображения оборудования"></textarea>
        <button @click.prevent="saveStuff(stuff.id)" v-if="Object.keys(stuff).length"
            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            {{ isEmpty ? 'Добавить' : 'Обновить' }}
        </button>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useStuff from "../../composables/stuff/stuff.js"

export default {
    props: {
        id: {
            type: String,
            required: true
        },
    },

    setup(props) {

        const { getStuff, storeStuff, stuff, isEmpty, errors } = useStuff();

        onMounted(async () => {
            await getStuff(props.id);
            stuff.value.node_id = props.id;
        }
        )

        const saveStuff = async (id) => {
            await storeStuff(id, { ...stuff.value })
        }

        return {
            saveStuff,
            stuff,
            isEmpty,
            errors
        }
    }
}
</script>
