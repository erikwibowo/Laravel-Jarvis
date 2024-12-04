<script setup>
import { MoonIcon, SunIcon } from "@heroicons/vue/24/outline";
import { useDark, useToggle } from "@vueuse/core";

const isDark = useDark();
const toggleDark = useToggle(isDark);
</script>
<template>
    <button
        v-tooltip="lang().label.dark_mode"
        class="inline-flex items-center justify-center p-2 rounded text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out"
        v-on:click="toggleDark()"
    >
        <SunIcon v-if="isDark" class="w-5 h-5 fill-current" />
        <MoonIcon v-if="!isDark" class="w-5 h-5 fill-current" />
    </button>
</template>
