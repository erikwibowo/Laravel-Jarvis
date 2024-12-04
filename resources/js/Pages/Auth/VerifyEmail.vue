<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head :title="lang().label.email_verification" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="flex flex-col mb-4">
            <h2 class="text-primary font-semibold text-xl">{{ lang().label.verify_email }}</h2>
            <small class="text-slate-400">{{ lang().label.verify_email_caption }}</small>
        </div>
        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ lang().label.email_verification_link }}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex flex-col gap-4 items-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ lang().button.resend_email_verification_link }} {{ form.processing ? '...' : '' }}
                </PrimaryButton>

                <div>
                    <Link :href="route('profile.show')"
                        class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-800">
                    {{ lang().label.edit_profile }}</Link>

                    <Link :href="route('logout')" method="post" as="button"
                        class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-800 ml-2">
                    {{ lang().label.logout }}
                    </Link>
                </div>
            </div>
        </form>
    </AuthenticationCard>
</template>
