<template>
    <!-- Sidebar -->
    <div
        class="fixed left-0 z-10 flex flex-col h-full text-white transition-all duration-300 border-none top-14 w-14 hover:w-48 md:w-48 bg-green-950 sidebar">
        <div class="flex flex-col justify-between flex-grow overflow-x-hidden overflow-y-auto">
            <ul class="flex flex-col py-4 space-y-1">
                <li>
                    <router-link :to="{ name: 'tasks.index' }"
                        class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-green-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-green-500 dark:hover:border-gray-800">
                        <span class="inline-flex items-center justify-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Журнал</span>
                    </router-link>
                </li>
                <li>
                    <a class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-green-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-green-500 dark:hover:border-gray-800"
                        href="#">
                        <span class="inline-flex items-center justify-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Профиль</span>
                    </a>
                </li>
                <div v-if="currentUser.is_admin">
                    <li class="hidden px-4 md:block">
                        <div class="flex flex-row items-center h-8 mt-5">
                            <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Управление</div>
                        </div>
                    </li>
                    <li>
                        <router-link :to="{ name: 'manage.devices' }"
                            class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-blue-500 dark:hover:border-gray-800">
                            <span class="inline-flex items-center justify-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </span>
                            <span class="ml-1 text-sm tracking-wide truncate">Настройки</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'manage.users' }"
                            class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-blue-500 dark:hover:border-gray-800">
                            <span class="inline-flex items-center justify-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>

                            </span>
                            <span class="ml-1 text-sm tracking-wide truncate">Пользователи</span>
                        </router-link>
                    </li>
                </div>


            </ul>
            <p class="hidden px-5 py-3 text-xs text-center mb-14 md:block">© INFy. 2023.</p>
        </div>
    </div>
    <!-- ./Sidebar -->
</template>

<script>
import useUsers from "../../../composables/users/users.js";

export default {
    setup() {
        const { currentUser } = useUsers();

        return {
            currentUser
        }
    }
}
</script>
