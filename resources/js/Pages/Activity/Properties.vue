<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref } from "vue";

const show = ref(false);
const props = defineProps({
    title: String,
    data: Object,
});

const closeModal = () => {
    show.value = false;
};
</script>
<template>
    <div>
        <div>
            <p
                class="text-primary underline cursor-pointer w-fit"
                @click="show = true"
            >
                {{ props.title }}
            </p>
        </div>
        <DialogModal :show="show" @close="closeModal" max-width="xl">
            <template #title>
                {{ props.title }}
            </template>

            <template #content>
                <div class="space-y-2">
                    <div class="rounded overflow-hidden">
                        <json-viewer
                            copyable
                            boxed
                            :value="props.data"
                        ></json-viewer>
                    </div>
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    {{ lang().button.close }}
                </SecondaryButton>
            </template>
        </DialogModal>
    </div>
</template>