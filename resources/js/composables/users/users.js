import { ref } from "vue";
import axios from "axios";

export default function useUsers() {
    const users = ref([]);
    const user = ref([]);
    const confirmPassword = ref("");
    const currentUser = window.Laravel.user;

    const getUsers = async () => {
        let response = await axios.get("/api/v1/users");

        users.value = response.data.data;
    };

    const getUser = async (id) => {
        user.value = [];
        let response = await axios.get("/api/v1/users/" + id);

        user.value = response.data.data;
    };

    return {
        users,
        user,
        confirmPassword,
        currentUser,
        getUsers,
        getUser,
    };
}
