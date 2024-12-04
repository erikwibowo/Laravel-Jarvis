<script setup>
import { PhotoIcon } from "@heroicons/vue/24/outline";
import { reactive, watchEffect } from "vue";

const props = defineProps({
    image: {
        type: String,
        default: null,
    },
    source: {
        type: String,
        default: "image",
    },
    tooltip: {
        type: String,
        default: "Click to select/change",
    },
});

const emit = defineEmits(["fileChange"]);

const data = reactive({
    image: null,
    file: null,
});

watchEffect(() => {
    if (props.image != null) {
        data.image = props.image;
    }
});

const selectImage = async (e) => {
    const file = e.target.files[0];
    if (file) {
        data.image = await toBase64(file);
        data.file = file;
        emit("fileChange", {
            file: data.file,
            source: props.source,
        });
    }
};

const toBase64 = (file) =>
    new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
    });
</script>

<template>
    <label
        :for="props.source"
        class="mt-1 text-slate-400 dark:text-slate-600 border-4 border-dashed border-slate-300 dark:border-slate-600 overflow-hidden flex justify-center items-center hover:cursor-pointer rounded"
        v-tooltip="props.tooltip"
    >
        <div
            v-if="!data.image"
            class="flex flex-col justify-center items-center m-10"
        >
            <PhotoIcon class="w-24 h-24" />
            <p class="text-center">Select {{ props.source }}</p>
        </div>
        <div v-else class="h-full">
            <img class="h-full" :src="data.image" alt="Image" />
        </div>
        <input
            class="hidden"
            type="file"
            accept=".jpg,.png,.gif,.svg"
            :id="props.source"
            @change="selectImage"
        />
    </label>
</template>
