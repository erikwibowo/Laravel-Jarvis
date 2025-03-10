<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: { type: String, default: "#", required: true },
    active: { type: String, required: true },
    need: { type: Array || String, required: true },
    linkName: { type: String, required: true },
});
</script>

<template>
    <li
        v-show="can(need)"
        v-bind:class="
            route().current(active)
                ? 'border-l-4 border-white font-semibold bg-white/20 dark:bg-primary/30'
                : ''
        "
        class="hover:bg-white/20 dark:hover:bg-primary/30"
    >
        <Link
            :href="route(href)"
            class="flex items-center py-1.5 px-3 space-x-2"
        >
            <slot name="icon"></slot>
            <span>{{ linkName }}</span>
        </Link>
    </li>
</template>
