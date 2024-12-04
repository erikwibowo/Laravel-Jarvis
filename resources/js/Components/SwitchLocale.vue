<script setup>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';
const locale = usePage().props.app.locale;
</script>
<template>
    <span v-tooltip="lang().label.set_locale"
        class="inline-flex items-center justify-center rounded text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out">
        <Link v-if="locale == 'id'" :href="route('set-locale', 'en')" class="flex justify-center items-center space-x-2">
        <p class="m-2 text-center w-5 h-5"> ID </p>
        </Link>
        <Link v-if="locale == 'en'" :href="route('set-locale', 'id')" class="flex justify-center items-center space-x-2">
        <p class="m-2 text-center w-5 h-5"> EN </p>
        </Link>
    </span>
</template>