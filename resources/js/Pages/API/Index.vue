<script setup>
import ApiTokenManager from '@/Pages/API/Partials/ApiTokenManager.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    tokens: Array,
    availablePermissions: Array,
    defaultPermissions: Array,
});
</script>

<template>
    <AppLayout :title="lang().label.api_tokens">
        <template #title>
            <span>{{lang().label.api_tokens}}</span>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <ApiTokenManager :tokens="tokens" :available-permissions="availablePermissions"
                    :default-permissions="defaultPermissions" />
            </div>
        </div>
    </AppLayout>
</template>
