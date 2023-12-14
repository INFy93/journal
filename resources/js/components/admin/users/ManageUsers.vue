<template>
    <header-title>Пользователи</header-title>
    <div class="hidden overflow-auto md:block">
        <div class="flex flex-wrap md:flex-nowrap md:space-x-3">
            <div class="w-full mt-2 mb-6 md:mb-0">
                <table class="w-full mt-3">
                    <thead class="border-b-2 border-gray-200 bg-gray-50">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left ">Имя пользователя</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Телефон</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Email</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left ">Роль</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Последний вход</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="bg-white" v-for="user in users" :key="user.id">
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <span class="font-bold">{{ user.name }}</span>
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                {{ user.phone }}
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                {{ user.email }}
                            </td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ user.isAdmin ? 'Администратор' :
                                'Пользователь' }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">давно</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>

<script>
import { onMounted } from 'vue';
import useUsers from '../../../composables/users/users.js';

export default {
    setup() {
        const { getUsers, users } = useUsers();

        onMounted(() => {
            getUsers();
            console.log(users.value)
        })

        return {
            users
        }
    }
}

</script>
