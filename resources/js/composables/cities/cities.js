import axios from "axios";
import { ref } from "vue";
import { useToast } from "vue-toastification";

export default function useCities() {
    const cities = ref([]);
    const city = ref([]);
    const toast = useToast();
    const errors = ref("");
    const getCities = async () => {
        let response = await axios.get("/api/v1/city");

        cities.value = response.data.data;
    };

    const getCity = async (id) => {
        city.value = [];
        let response = await axios.get("/api/v1/city/" + id);

        city.value = response.data.data;
    };

    const storeCity = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/v1/city", data);
            toast.success("Пункт успешно добавлен.");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateCity = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/city/v1/" + id, city.value);
            toast.success("Пункт успешно обновлен.");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    return {
        cities,
        city,
        errors,
        updateCity,
        getCities,
        getCity,
        storeCity,
    };
}
