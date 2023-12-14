import { ref } from "vue";
import axios from "axios";

export default function useUsers() {
    const users = ref([]);
    const currentUser = window.Laravel.user;

    const getUsers = async () => {
        let response = await axios.get("/api/v1/users");

        users.value = response.data.data;
    };

    return {
        users,
        currentUser,
        getUsers,
    };
}
