<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref } from "vue";

const show = ref(false);
const props = defineProps({
    title: String,
    caption: {
        type: String,
        default: null,
    },
    permissions: Object,
});

const groupedData = [];
let currentGroup = null;

props.permissions?.forEach((permission) => {
    const groupName = permission.name.split(" ")[0];
    const action = permission.name.split(" ")[1];

    if (currentGroup !== groupName) {
        currentGroup = groupName;
        groupedData.push({
            group: currentGroup,
            data: [{ name: action }],
        });
    } else {
        const groupIndex = groupedData.findIndex(
            (group) => group.group === groupName
        );
        if (groupIndex !== -1) {
            groupedData[groupIndex].data.push({ name: action });
        }
    }
});

const closeModal = () => {
    show.value = false;
};
</script>
<template>
    <div>
        <div>
            <p
                v-tooltip="lang().label.show_permission"
                class="text-primary underline cursor-pointer w-fit"
                @click="show = true"
            >
                {{ props.title }}
            </p>
        </div>
        <DialogModal :show="show" @close="closeModal" max-width="md">
            <template #title>
                {{ lang().label.permission }}
                {{ props.caption ? props.caption : props.title }}
            </template>

            <template #content>
                <div class="space-y-2">
                    <div
                        class="mt-2"
                        v-for="(permission, index) in groupedData"
                        :key="index"
                    >
                        <p class="font-bold text-primary capitalize">
                            {{ permission.group }}
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <p
                                v-for="(data, index) in permission.data"
                                :key="index"
                                v-bind:class="data.name == 'delete' ? 'text-red-500 font-semibold':''"
                                class="mt-1 mb-4"
                            >
                                {{ data.name }}
                            </p>
                        </div>
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
