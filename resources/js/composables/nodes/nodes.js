import axios from "axios";
import {ref} from "vue";
import {useToast} from "vue-toastification";

export default function useNodes() {
    const nodes = ref([]);
    const node = ref([]);
    const cityId = ref('');
    const nodes_errors = ref('');
    const toast = useToast();
    const getNodes = async(id) => {
        let response = await axios.get("/api/node/" + id);

        nodes.value = response.data.data

        cityId.value = id;
    }

    const getSingleNode = async(id) => {
        node.value = [];
        let response = await axios.get("/api/nodes/" + id);

        node.value = response.data.data
    }

    const storeNodes = async(data) => {
        nodes_errors.value = '';
        try {
            await axios.post("/api/nodes", data);
            toast.success("Узел успешно добавлен")
        } catch (e) {
            if (e.response.status === 422) {
                nodes_errors.value = e.response.data.errors
            }
        }
    }

    const updateNode = async(id) => {
        nodes_errors.value = '';
        try {
            await axios.put("/api/nodes/" + id, node.value);
            toast.success("Узел успешно обновлен")
        } catch (e) {
            if (e.response.status === 422) {
                nodes_errors.value = e.response.data.errors
            }
        }
    }

    return {
        nodes,
        node,
        cityId,
        nodes_errors,
        updateNode,
        storeNodes,
        getNodes,
        getSingleNode
    }
}
