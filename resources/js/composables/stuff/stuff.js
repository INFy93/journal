import { ref } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import axios from "axios";

export default function useStuff() {
    const stuff = ref([]);
    const errors = ref("");
    const isEmpty = ref(false);

    const router = useRouter();
    const toast = useToast();

    const getStuff = async (id) => {
        let response = await axios.get("/api/v1/stuff/" + id);

        stuff.value = response.data.data;

        if (!Object.keys(stuff.value).length) {
            stuff.value.node_id = id;
            stuff.value.stuff = "Ящик";
            isEmpty.value = true;
        }
    };

    const storeStuff = async (id, data) => {
        errors.value = "";
        if (isEmpty.value) {
            try {
                await axios.post("/api/v1/stuff", data);
                toast.success("Оборудование успешно добавлено.");
                await router.push({ name: "main.index" });
            } catch (e) {
                if (e.response.status === 422) {
                    errors.value = e.response.data.errors;
                    toast.error("Произошла ошибка: заполните все поля.");
                }
            }
        } else {
            try {
                await axios.put("/api/v1/stuff/" + id, stuff.value);
                toast.success("Оборудование успешно обновлено.");
                await router.push({ name: "main.index" });
            } catch (e) {
                if (e.response.status === 422) {
                    errors.value = e.response.data.errors;
                    toast.error("Произошла ошибка: заполните все поля.");
                }
            }
        }
    };

    return {
        stuff,
        errors,
        isEmpty,
        getStuff,
        storeStuff,
    };
}
