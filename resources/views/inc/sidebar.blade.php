<!-- Sidebar -->
<div
    class="fixed flex flex-col top-14 left-0 w-14 hover:w-48 md:w-48 bg-green-950 h-full text-white transition-all duration-300 border-none z-10 sidebar">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
        <ul class="flex flex-col py-4 space-y-1">
            <li>
                <router-link :to="{ name: 'tasks.index' }"
                   class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-green-800 dark:hover:bg-gray-600 text-white-600 hover:text-white border-l-4 border-transparent hover:border-green-500 dark:hover:border-gray-800 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Журнал</span>
                </router-link>
            </li>
            <li>
                <a href="#"
                   class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-green-800 dark:hover:bg-gray-600 text-white-600 hover:text-white border-l-4 border-transparent hover:border-green-500 dark:hover:border-gray-800 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Профиль</span>
                </a>
            </li>

                <li class="px-4 hidden md:block">
                    <div class="flex flex-row items-center mt-5 h-8">
                        <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Управление</div>
                    </div>
                </li>
                <li>
                    <a href="#"
                       class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
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

        </ul>
        <p class="mb-14 px-5 py-3 hidden md:block text-center text-xs">© INFy. {{ date('Y') }}.</p>
    </div>
</div>
<!-- ./Sidebar -->
