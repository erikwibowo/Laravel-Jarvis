<script setup>
import { PhotoIcon, PlusIcon } from "@heroicons/vue/24/outline";
import { reactive } from "vue";
import InputError from "./InputError.vue";

const emit = defineEmits(["fileChange"]);

const data = reactive({
    images: [],
    files: [],
});

const selectImage = async (e) => {
    const files = e.target.files;
    data.images = [];
    data.files = [];
    for (let index = 0; index < files.length; index++) {
        data.images.push(await toBase64(files[index]));
        data.files.push(files[index]);
    }
    emit("fileChange", {
        files: data.files,
    });
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
    <div>
        <label
            for="images"
            class="mt-1 w-full text-slate-600 dark:text-slate-400 border-4 border-dashed border-slate-600 dark:border-slate-400 overflow-hidden flex justify-center items-center hover:cursor-pointer rounded p-2"
        >
            <div
                v-if="data.images.length == 0"
                class="flex flex-col items-center justify-center m-10"
                v-tooltip="'Click to add some images'"
            >
                <PhotoIcon class="w-24 h-24" />
                <p class="text-center">Select some images</p>
            </div>
            <div v-else class="h-full grid grid-cols-2 md:grid-cols-3 gap-2">
                <label
                    for="images"
                    class="mt-1 w-full text-slate-600 dark:text-slate-400 border-2 border-dashed border-slate-300 dark:border-slate-400 overflow-hidden flex justify-center items-center hover:cursor-pointer rounded"
                    v-tooltip="'Click to add some images'"
                >
                    <PlusIcon class="w-16 h-16" />
                </label>
                <div
                    v-for="(image, index) in data.images"
                    class="flex flex-col justify-center items-center"
                >
                    <div class="relative">
                        <img
                            @click.prevent
                            class="w-60 h-auto rounded object-center object-cover"
                            :src="image"
                            alt="Image"
                        />
                    </div>
                    <InputError
                        class="mt-2 text-center"
                        :message="$page.props.errors['images.' + index]"
                    />
                </div>
            </div>
            <input
                class="hidden"
                type="file"
                multiple
                accept=".jpg,.png,.gif,.svg,.webp"
                id="images"
                @change="selectImage"
            />
        </label>
    </div>
</template>
