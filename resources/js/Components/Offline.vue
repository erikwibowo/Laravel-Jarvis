<script setup>
import OfflineAnimation from "@/Animations/offline.json";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ArrowPathIcon } from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";
import { useDark } from "@vueuse/core";

const isDark = useDark();
</script>
<template>
    <div
        class="flex relative w-full h-screen bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-slate-100 overflow-x-hidden text-base"
    >
        <div class="flex flex-col w-full space-y-4 justify-center items-center">
            <Vue3Lottie
                :animationData="OfflineAnimation"
                :height="250"
                :width="250"
            />
            <h1 class="text-2xl">Opps! Koneksi internet tidak tersedia</h1>
            <Link :href="route().current()">
                <PrimaryButton class="space-x-2">
                    <ArrowPathIcon class="w-4 h-auto" /> <span>Muat Ulang</span>
                </PrimaryButton></Link
            >
        </div>
    </div>
</template>
