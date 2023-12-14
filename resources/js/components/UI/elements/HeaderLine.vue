<template>
    <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
        <div class="flex items-center justify-start md:justify-start w-14 md:w-48 h-14 bg-gray-800 border-none">
            <img src="/storage/img/logo1.png" alt="" style="max-width: 45%; margin: 0 auto">

        </div>
        <div class="flex justify-between items-center h-14 bg-gray-200 header-right">
            <ul class="flex items-center text-gray-700 ml-auto">
                <li>
                    <a href="#" class="hover:underline">{{ currentUser.name }}</a>
                </li>
                <li>
                    <div class="block w-px h-6 mx-3 bg-gray-400 dark:bg-gray-700"></div>
                </li>
                <li>
                    <a href="/" @click.prevent="logout"  class="flex items-center mr-4 hover:text-gray-600">
            <span class="inline-flex mr-1">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </span>
                        Выйти
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display:
none;">
                        <input type="hidden" name="_token" :value="token">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import useUsers from "../../../composables/users/users.js";
export default {
    setup()
    {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const { currentUser } = useUsers();
        const logout = () => {
            document.getElementById('logout-form').submit();
        }

        return {
            token,
            currentUser,
            logout
        }
    }
}
</script>

