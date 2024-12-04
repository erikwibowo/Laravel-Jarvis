<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    variant: {
        type: String,
        default: 'info',
    },
});
</script>

<template>
    <div>
        <button v-if="variant == 'info'" :type="type"
            class="inline-flex items-center px-3 py-1.5 bg-blue-500 dark:bg-blue-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-blue-400 focus:bg-blue-500 dark:focus:bg-blue-400 active:bg-blue-500/60 dark:active:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition ease-in-out duration-150">
            <slot />
        </button>
        <button v-if="variant == 'success'" :type="type"
            class="inline-flex items-center px-3 py-1.5 bg-green-500 dark:bg-green-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 dark:hover:bg-green-400 focus:bg-green-500 dark:focus:bg-green-400 active:bg-green-500/60 dark:active:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition ease-in-out duration-150">
            <slot />
        </button>
        <button v-if="variant == 'danger'" :type="type"
            class="inline-flex items-center px-3 py-1.5 bg-rose-500 dark:bg-rose-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-rose-600 dark:hover:bg-rose-400 focus:bg-rose-500 dark:focus:bg-rose-400 active:bg-rose-500/60 dark:active:bg-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition ease-in-out duration-150">
            <slot />
        </button>
        <button v-if="variant == 'warning'" :type="type"
            class="inline-flex items-center px-3 py-1.5 bg-yellow-400 dark:bg-yellow-500 border border-transparent font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-yellow-500 dark:hover:bg-yellow-400 focus:bg-yellow-500 dark:focus:bg-yellow-400 active:bg-yellow-500/60 dark:active:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition ease-in-out duration-150">
            <slot />
        </button>
        <button v-if="variant == 'primary'" :type="type"
            class="inline-flex items-center px-3 py-1.5 primary dark:primary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:prim6ry dark:hover:prim4ry focus:primary dark:focus:prim4ry active:primary/60 dark:active:prim4ry focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition ease-in-out duration-150">
            <slot />
        </button>
        <button v-if="variant == 'secondary'" :type="type"
            class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-500 font-semibold text-xs text-slate-700 dark:text-slate-300 uppercase tracking-widest shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-slate-800 disabled:opacity-25 transition ease-in-out duration-150">
            <slot />
        </button>
    </div>
</template>
