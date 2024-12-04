<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: String,
    label: String,
});
</script>
<template>
    <Link
        :href="href"
        class="inline-flex items-center justify-start sm:justify-center p-2 rounded hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 transition duration-150 ease-in-out w-full"
        >{{ label }}</Link
    >
</template>
