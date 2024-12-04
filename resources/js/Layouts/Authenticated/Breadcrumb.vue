<script setup>
import { ChevronRightIcon } from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";

defineProps({
    breadcrumbs: {
        type: Object,
        default: [],
    },
});
</script>

<template>
    <div
        class="hidden md:flex justify-start items-center space-x-2 text-slate-500 dark:text-slate-200 text-sm font-normal"
    >
        <div
            v-for="(breadcrumb, index) in breadcrumbs"
            :key="index"
            class="flex items-center space-x-2"
        >
            <ChevronRightIcon class="w-3 h-3" />
            <Link :href="breadcrumb.href">
                {{ breadcrumb.label }}
            </Link>
        </div>
    </div>
</template>
