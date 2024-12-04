<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    active: Boolean,
    href: String,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-primary dark:border-primary text-left text-base font-medium text-primary bg-primary/10 focus:outline-none focus:text-primary focus:bg-primary/20 focus:border-primary/80 transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 hover:border-slate-300 dark:hover:border-slate-600 focus:outline-none focus:text-slate-800 dark:focus:text-slate-200 focus:bg-slate-50 dark:focus:bg-slate-700 focus:border-slate-300 dark:focus:border-slate-600 transition duration-150 ease-in-out';
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" :class="classes" class="w-full text-left">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
        <slot />
        </Link>
    </div>
</template>
