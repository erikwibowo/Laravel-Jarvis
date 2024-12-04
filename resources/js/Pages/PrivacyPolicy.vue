<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";

defineProps({
    policy: String,
});
</script>

<template>
    <Head :title="lang().label.privacy_policy" />

    <div class="font-sans text-slate-900 dark:text-slate-100 antialiased">
        <div class="pt-4 bg-slate-100 dark:bg-slate-900">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <AuthenticationCardLogo />
                </div>

                <div
                    class="w-full sm:max-w-2xl mt-6 p-6 bg-white dark:bg-slate-800 shadow overflow-hidden sm:rounded prose dark:prose-invert"
                    v-html="policy"
                />
            </div>
        </div>
    </div>
</template>
