<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-full p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                Изменить имя узла
                            </DialogTitle>
                            <div v-if="nodes_errors">
                                <div v-for="(v, k) in nodes_errors" :key="k"
                                    class="w-full px-3 py-2 pr-0 mb-6 font-bold text-white bg-red-500 rounded shadow-lg">
                                    <p v-for="error in v" :key="error" class="text-sm">
                                        {{ error }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700" for="name">Узел</label>
                                <div class="mt-1">
                                    <input id="name" v-model="node.node_name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="name" type="text" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="saveNode(node.id, node.city_id)">
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
import useNodes from "../../composables/nodes/nodes.js";
export default {
    setup(props, { emit }) {
        const { isOpen, openModal, closeModal } = useDialogs();
        const { node, nodes_errors, updateNode, getSingleNode } = useNodes();

        const openNodeEditDialog = (id) => {
            getSingleNode(id);
            openModal()
        }

        const saveNode = async (id, city_id) => {
            await updateNode(id);
            closeModal();
            emit("updateNodes", city_id);
        }

        return {
            isOpen,
            node,
            nodes_errors,
            saveNode,
            openNodeEditDialog,
            openModal,
            closeModal
        }
    }
}
</script>

