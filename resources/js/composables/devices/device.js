import { ref } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import axios from "axios";

export default function useDevice() {
    const device = ref([]);
    const devices = ref([]);
    const errors = ref("");
    const deviceErrors = ref("");
    const deviceId = ref("");

    const router = useRouter();
    const toast = useToast();
    const getDevice = async (id) => {
        let response = await axios.get("/api/v1/devices/" + id);

        device.value = response.data.data;
    };
    //getting device by NODE ID!!!
    const getDevices = async (id) => {
        let response = await axios.get("/api/v1/device/" + id);

        devices.value = response.data.data;
        deviceId.value = id;
    };

    const storeDevice = async (data) => {
        deviceErrors.value = "";
        try {
            await axios.post("/api/v1/devices", data);
            toast.success("Устройство успешно добавлено");
        } catch (e) {
            if (e.response.status === 422) {
                deviceErrors.value = e.response.data.errors;
            }
        }
    };

    const updateDevice = async (id) => {
        deviceErrors.value = "";
        try {
            await axios.put("/api/v1/devices/" + id, device.value);
            toast.success("Устройство успешно обновлено");
        } catch (e) {
            if (e.response.status === 422) {
                deviceErrors.value = e.response.data.errors;
            }
        }
    };

    return {
        device,
        devices,
        errors,
        deviceId,
        deviceErrors,
        updateDevice,
        storeDevice,
        getDevices,
        getDevice,
    };
}
