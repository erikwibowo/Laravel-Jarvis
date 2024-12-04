<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-rose-600 dark:text-rose-400">
            {{ message }}
        </p>
    </div>
</template>
