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
        class="inline-flex items-center px-4 py-2 bg-primary dark:bg-primary border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary/90 dark:hover:bg-primary/80 focus:bg-primary dark:focus:bg-primary/80 active:bg-primary/60 dark:active:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
