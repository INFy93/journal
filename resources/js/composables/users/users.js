import { ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";

export default function useUsers() {
    const users = ref([]);
    const user = ref([]);
    const confirmPassword = ref("");
    const errors = ref("");
    const toast = useToast();
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

    const updateUser = async (id) => {
        errors.value = "";
        if (user.value.password && user.value.password != confirmPassword.value)
            return toast.error("Пароли не совпадают!");
        try {
            await axios.put("/api/v1/users/" + id, user.value);
            toast.success("Пользователь успешно обновлен");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    return {
        users,
        user,
        confirmPassword,
        currentUser,
        errors,
        getUsers,
        getUser,
        updateUser,
    };
}
