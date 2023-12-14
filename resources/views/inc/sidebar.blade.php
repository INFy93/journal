<!-- Sidebar -->
<div
    class="fixed left-0 z-10 flex flex-col h-full text-white transition-all duration-300 border-none top-14 w-14 hover:w-48 md:w-48 bg-green-950 sidebar">
    <div class="flex flex-col justify-between flex-grow overflow-x-hidden overflow-y-auto">
        <ul class="flex flex-col py-4 space-y-1">
            <li>
                <router-link :to="{ name: 'tasks.index' }"
                    class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-green-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-green-500 dark:hover:border-gray-800">
                    <span class="inline-flex items-center justify-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Журнал1</span>
                </router-link>
            </li>
            <li>
                <a href="#"
                    class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-green-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-green-500 dark:hover:border-gray-800">
                    <span class="inline-flex items-center justify-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Профиль</span>
                </a>
            </li>

            <li class="hidden px-4 md:block">
                <div class="flex flex-row items-center h-8 mt-5">
                    <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Управление</div>
                </div>
            </li>
            <li>
                <a href="#"
                    class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-blue-500 dark:hover:border-gray-800">
                    <span class="inline-flex items-center justify-center ml-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </span>
                    <span class="ml-1 text-sm tracking-wide truncate">Настройки</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="relative flex flex-row items-center pr-6 border-l-4 border-transparent h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white hover:border-blue-500 dark:hover:border-gray-800">
                    <span class="inline-flex items-center justify-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>

                    </span>
                    <span class="ml-1 text-sm tracking-wide truncate">Пользователи</span>
                </a>
            </li>

        </ul>
        <p class="hidden px-5 py-3 text-xs text-center mb-14 md:block">© INFy. {{ date('Y') }}.</p>
    </div>
</div>
<!-- ./Sidebar -->
