import { ref } from "vue";
export default function useDialogs() {
    const isOpen = ref(false);

    function closeModal() {
        return isOpen.value = false;
    }

    function openModal() {
        return isOpen.value = true;
    }

    return {
        isOpen,
        closeModal,
        openModal
    };
}
