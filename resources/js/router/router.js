import { createRouter, createWebHistory } from "vue-router";

import MainComponent from "../components/main/MainComponent.vue";
import TaskComponent from "../components/tasks/TaskComponent.vue";
import AddTaskComponent from "../components/tasks/AddTaskComponent.vue";
import StuffComponent from "../components/stuffs/StuffComponent.vue";
import EditTaskComponent from "../components/tasks/EditTaskComponent.vue";

import ManageDevices from "../components/admin/devices/ManageDevices.vue";
import ManageUsers from "../components/admin/users/ManageUsers.vue";

import useUsers from "../composables/users/users.js";
const user = useUsers();
const routes = [
    {
        path: "/main",
        name: "main.index",
        component: MainComponent,
        meta: {
            title: "Журнал",
        },
    },
    {
        path: "/tasks/:id/",
        name: "tasks.index",
        props: true,
        component: TaskComponent,
        meta: {
            title: "Журнал",
        },
    },
    {
        path: "/tasks/:id/add",
        name: "tasks.add",
        component: AddTaskComponent,
        props: true,
        meta: {
            title: "Добавить запись",
        },
    },
    {
        path: "/task/:id/:node/:device_id/edit",
        name: "task.edit",
        component: EditTaskComponent,
        props: true,
        meta: {
            title: "Редактировать запись",
        },
    },
    {
        path: "/node/:id/stuff",
        name: "node.add.stuff",
        component: StuffComponent,
        props: true,
        meta: {
            title: "Добавить оборудование",
        },
    },
    {
        path: "/manage/devices",
        name: "manage.devices",
        component: ManageDevices,
        meta: {
            title: "Управление устройствами",
        },
        beforeEnter: (to, from, next) => {
            if (user.currentUser.is_admin) next();
            else next("/main");
        },
    },
    {
        path: "/manage/users",
        name: "manage.users",
        component: ManageUsers,
        meta: {
            title: "Управление пользователями",
        },
        beforeEnter: (to, from, next) => {
            if (user.currentUser.is_admin) next();
            else next("/main");
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from) => {
    document.title = to.meta?.title ?? "Журнал";
});

export default router;
