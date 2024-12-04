<script setup>
import { computed, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import {
    CheckCircleIcon,
    InformationCircleIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline";

const show = ref(true);
const style = computed(
    () => usePage().props.jetstream.flash?.style || "success"
);
const message = computed(() => usePage().props.jetstream.flash?.text || "");

watch(message, async () => {
    show.value = true;
});

setTimeout(() => {
    show.value = false;
}, 3000);
</script>

<template>
    <transition name="slide-fade">
        <div
            v-if="show && message"
            class="fixed top-4 right-4 w-8/12 md:w-6/12 lg:w-3/12 z-[100]"
        >
            <div
                v-bind:class="
                    style == 'success' ? 'bg-green-500' : 'bg-blue-500'
                "
                class="flex p-4 justify-between items-center rounded shadow"
            >
                <div>
                    <CheckCircleIcon
                        v-if="style == 'success'"
                        class="h-8 w-8 text-white"
                        fill="currentColor"
                    />
                    <InformationCircleIcon
                        v-else
                        class="h-8 w-8 text-white"
                        fill="currentColor"
                    />
                </div>
                <div
                    class="mx-3 text-sm font-medium text-white"
                    v-html="message"
                ></div>
                <button
                    @click="show = false"
                    type="button"
                    class="ml-auto bg-white/20 text-white rounded focus:ring-2 focus:ring-white/50 p-1.5 hover:bg-white/30 h-8 w-8"
                >
                    <span class="sr-only">Close</span>
                    <XMarkIcon class="w-5 h-5" />
                </button>
            </div>
        </div>
    </transition>
</template>
<style>
/*
    Enter and leave animations can use different
    durations and timing functions.
    */
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
</style>
