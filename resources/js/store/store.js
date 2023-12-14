import { createPinia, setActivePinia, defineStore } from "pinia";
const pinia = createPinia();
setActivePinia(pinia);
export const useUserStore = defineStore("user", {
    state: () => ({
        user: null,
    }),

    actions: {
        async fetchUser() {
            const userInfo = window.Laravel.user;


            this.user = userInfo;
        },
    },
});
