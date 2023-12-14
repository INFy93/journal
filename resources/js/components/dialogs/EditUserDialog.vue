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
                                Редактировать пользователя
                            </DialogTitle>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700" for="name">Имя пользователя</label>
                                <div class="mt-1">
                                    <input id="name" v-model="user.name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="name" type="text" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700" for="name">E-mail</label>
                                <div class="mt-1">
                                    <input id="email" v-model="user.email"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="name" type="email" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700" for="name">Телефон</label>
                                <div class="mt-1">
                                    <input id="email" v-model="user.phone"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="name" type="text" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700" for="name">Пароль (оставить пустым -
                                    без изменений)</label>
                                <div class="mt-1">
                                    <input id="email" v-model="user.password"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="name" type="password" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700" for="name">Подтверждение
                                    пароля</label>
                                <div class="mt-1">
                                    <input id="email" v-model="confirmPassword"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-2/3 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="name" type="password" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="button"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
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
import useUsers from "../../composables/users/users";
export default {
    setup(props, { emit }) {
        const { isOpen, openModal, closeModal } = useDialogs();
        const { getUser, user, confirmPassword } = useUsers();

        const openUserEditDialog = (id) => {
            getUser(id);
            openModal();
        }
        return {
            user,
            confirmPassword,
            isOpen,
            openModal,
            closeModal,
            openUserEditDialog
        }
    }
}
</script>

