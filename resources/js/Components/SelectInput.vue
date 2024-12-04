<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: Number | String,
    dataSet: {
        type: Object,
        default: [],
    },
    error: {
        type: String,
        default: null,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select ref="input"
        v-bind:class="error ? 'border-rose-500 dark:border-rose-400 dark:bg-slate-900 dark:text-slate-300 focus:border-rose-500 dark:focus:border-rose-400 focus:ring-rose-500 dark:focus:ring-rose-400 ' : 'border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-primary dark:focus:border-primary focus:ring-primary dark:focus:ring-primary '"
        class="rounded shadow-sm placeholder:text-slate-300 dark:placeholder:text-slate-700" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)">
        <option v-for="(data, index) in dataSet" :key="index" :value="data.value">{{ data.label }}</option>
    </select>
</template>
