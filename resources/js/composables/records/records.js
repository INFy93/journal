import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
export default function useRecords() {
    const records = ref([]);
    const record = ref([]);
    const errors = ref("");
    const router = useRouter();
    const toast = useToast();

    const getAllRecordsByNode = async (node_id, page = 1) => {
        let response = await axios.get("/api/v1/records/node/" + node_id);

        records.value = response.data.data;
    };

    const getRecord = async (id) => {
        let response = await axios.get("/api/v1/records/" + id);

        record.value = response.data.data;
    };

    const storeRecord = async (data) => {
        try {
            await axios.post("/api/v1/records", data);
            await router.push({ name: "tasks.index" });
            toast.success("Запись успешно добавлена.");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };
    const updateRecord = async (id) => {
        try {
            await axios.put("/api/v1/records/" + id, record.value);
            await router.push({ name: "tasks.index" });
            toast.success("Запись успешно обновлена.");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    return {
        records,
        record,
        errors,
        getAllRecordsByNode,
        getRecord,
        storeRecord,
        updateRecord,
    };
}
