<script setup>
import { ArrowSmallUpIcon } from "@heroicons/vue/24/outline";
import { reactive } from "vue";
const data = reactive({
    show: false,
});
const toTop = () => {
    window.scrollTo(0, 0);
};
window.addEventListener("scroll", () => {
    let scrollPos = window.scrollY;
    if (scrollPos > 0) {
        data.show = true;
    } else {
        data.show = false;
    }
});
</script>
<template>
    <a
        v-show="data.show"
        @click="toTop"
        v-tooltip="lang().label.back_to_top"
        class="h-10 w-10 bg-primary/50 fixed flex m-auto justify-center items-center z-[9999] bottom-4 right-4 rounded text-white hover:bg-primary cursor-pointer"
    >
        <ArrowSmallUpIcon class="w-6 h-6" />
    </a>
</template>
