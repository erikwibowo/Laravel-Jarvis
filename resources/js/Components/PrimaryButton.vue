<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center px-4 py-2 bg-indigo-500 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-indigo-500/80 dark:hover:bg-indigo-500/90 focus:bg-indigo-500/80 dark:focus:bg-indigo-500/80 active:bg-indigo-500 dark:active:bg-indigo-500/80 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-indigo-500 transition ease-in-out duration-150 disabled:bg-indigo-500/80">
        <slot />
    </button>
</template>
