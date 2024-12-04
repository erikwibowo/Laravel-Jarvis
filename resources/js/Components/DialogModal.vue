<script setup>
import { XMarkIcon } from "@heroicons/vue/24/outline";
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "xl",
    },
    closeable: {
        type: Boolean,
        default: false,
    },
});

const close = () => {
    emit("close");
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="px-6 py-4">
            <div
                class="flex justify-between items-center text-lg font-medium text-slate-900 dark:text-slate-100 space-x-2"
            >
                <slot name="title" />
                <button
                    class="inline-flex items-center p-2 border border-slate-200 dark:border-slate-700 text-sm leading-4 font-medium rounded text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-300 focus:outline-none focus:bg-slate-50 dark:focus:bg-slate-700 active:bg-slate-50 dark:active:bg-slate-700 transition ease-in-out duration-150"
                    @click.prevent="close"
                >
                    <XMarkIcon class="w-4 h-auto" />
                </button>
            </div>

            <div class="mt-4 text-sm text-slate-600 dark:text-slate-400">
                <slot name="content" />
            </div>
        </div>

        <div
            class="flex flex-row justify-end px-6 py-4 bg-slate-100 dark:bg-slate-900/30 text-right"
        >
            <slot name="footer" />
        </div>
    </Modal>
</template>
