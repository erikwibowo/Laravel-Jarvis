<script setup>
const props = defineProps({
    labelName: { type: String, required: true },
    needs: { type: Array, required: false },
});
</script>

<template>
    <template v-if="needs">
        <li v-show="can(needs)">
            <span class="font-md uppercase font-semibold px-3">{{
                labelName
            }}</span>
        </li>
    </template>
    <template v-else>
        <li>
            <span class="font-md uppercase font-semibold px-3">
                {{ labelName }}
            </span>
        </li>
    </template>
</template>

<style scoped></style>
