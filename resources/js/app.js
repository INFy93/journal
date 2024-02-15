import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue";

import router from "./router/router.js";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp({});
app.config.compilerOptions.whitespace = "preserve";

//toast options
const options = {
    position: "top-right",
    transition: "Vue-Toastification__fade",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false,
};

import Main from "./components/main/MainComponent.vue";
import Tasks from "./components/tasks/TaskComponent.vue";
import HeaderSlot from "./components/UI/elements/HeaderSlot.vue";
import HeaderLine from "./components/UI/elements/HeaderLine.vue";
import Sidebar from "./components/UI/elements/SideBar.vue";
import { TailwindPagination } from "laravel-vue-pagination";
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

import EditCityDialog from "./components/dialogs/EditCityDialog.vue";
import EditNodeDialog from "./components/dialogs/EditNodeDialog.vue";
import EditDeviceDialog from "./components/dialogs/EditDeviceDialog.vue";
import EditUserDialog from "./components/dialogs/EditUserDialog.vue";

app.component("main", Main);
app.component("tasks", Tasks);
app.component("header-title", HeaderSlot);

app.component("header-line", HeaderLine);
app.component("sidebar-vue", Sidebar);

app.component("TailwindPagination", TailwindPagination);

//dialog
app.component("TransitionRoot", TransitionRoot);
app.component("TransitionChild", TransitionChild);
app.component("Dialog", Dialog);
app.component("DialogTitle", DialogTitle);
app.component("DialogOverlay", DialogOverlay);
app.component("DialogPanel", DialogPanel);

app.component("updateCity", EditCityDialog);
app.component("updateNode", EditNodeDialog);
app.component("updateDevice", EditDeviceDialog);
app.component("updateUser", EditUserDialog);

app.use(Toast, options);

app.use(router).mount("#app");
