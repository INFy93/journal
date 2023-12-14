<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle
                                as="h3"
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Изменить имя устройства
                            </DialogTitle>
                            <div v-if="deviceErrors">
                                <div
                                    v-for="(v, k) in deviceErrors"
                                    :key="k"
                                    class="w-full px-3 mb-6 bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0"
                                >
                                    <p v-for="error in v" :key="error" class="text-sm">
                                        {{ error }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    for="name"
                                >Устройство</label
                                >
                                <div class="mt-1">
                                    <input
                                        id="name"
                                        v-model="device.device_name"
                                        class="block mt-1 w-full md:w-2/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="name"
                                        type="text"
                                    />
                                </div>
                            </div>

                            <div class="mt-4">
                                <button
                                    type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="saveDevice(device.id, device.node.id)"
                                >
                                   Изменить
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import useDialogs from "../../composables/dialogs/dialogs.js";
import useDevice from "../../composables/devices/device.js";
export default {
    setup(props, { emit }) {
        const { isOpen, openModal, closeModal } = useDialogs();
        const { device, deviceErrors, getDevice, updateDevice } = useDevice();

        const openDeviceEditDialog = (id) => {
            getDevice(id);
            openModal()
        }

        const saveDevice = async(id, node_id) => {
            await updateDevice(id);
            closeModal();
            emit("updateDevice", node_id);
        }

        return {
            isOpen,
            device,
            deviceErrors,
            saveDevice,
            openDeviceEditDialog,
            openModal,
            closeModal
        }
    }
}
</script>

