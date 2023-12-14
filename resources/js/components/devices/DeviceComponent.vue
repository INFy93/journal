<template>
    <div v-if="device.node">
        <header-title>
            {{ isEmpty ? 'Добавить' : 'Обновить' }} оборудование на устройство  {{ device.device_name }} ({{  (device.node.node_name) }})
        </header-title>
    </div>

        <div v-if="errors">
            <div
                v-for="(v, k) in errors"
                :key="k"
                class="w-full md:w-1/3 px-3 mb-6 bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0"
            >
                <p v-for="error in v" :key="error" class="text-sm">
                    {{ error }}
                </p>
            </div>
        </div>
    <div
        v-if="device.node"
        class="w-full  mt-2 md:w-2/3 px-3 mb-6 md:mb-0">
        <label
            for="time"
            class="block text-sm font-medium text-gray-700"
        >Устройство</label
        >
        <textarea
            v-model="stuffInfo.stuff"
            id="message" rows="4"
            class="block  mt-1 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Описание работ..."></textarea>

    </div>
    <div class="flex mt-2 ml-3 space-x-2">
        <button
            @click="saveStuff(stuff.id)"
            type="submit"
            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
        >
            {{ isEmpty ? 'Добавить' : 'Обновить' }}
        </button>
        <router-link
            :to="{ name: 'tasks.index' }"
            class="inline-flex space-x-2 items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
        >
            Вернуться
        </router-link>
    </div>
</template>

<script>
import useDevice from "../../composables/devices/device.js";
import {onMounted, reactive, ref} from "vue";
export default {
    props: {
        id: {
            required: true,
            type: String
        },
    },
    setup(props) {
        const { device, stuff, isEmpty, errors, getStuff, storeStuff, getDevice } = useDevice()
        const stuffInfo = reactive({});
        const deviceName = ref('');
        onMounted(async () => {
           await getDevice(props.id);
           await getStuff(props.id);
           stuffInfo.device_id = stuff.value.device_id ? parseInt(stuff.value.device_id) : '';
           stuffInfo.stuff = stuff.value.stuff ? stuff.value.stuff : '';
           deviceName.value = device.value.device_name;        })

        const saveStuff = async(id) => {
            await storeStuff(id, deviceName.value, {...stuffInfo})
        }
        return {
            device,
            stuff,
            isEmpty,
            errors,
            stuffInfo,
            saveStuff
        }
    }
}

</script>
