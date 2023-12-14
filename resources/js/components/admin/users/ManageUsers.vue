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
                                {{ user.name }}
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
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">Удалить / Блок</td>
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
