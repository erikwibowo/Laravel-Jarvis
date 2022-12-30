<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuntheticationIllustration from '@/Components/AuntheticationIllustration.vue';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>

    <Head title="Email Verification" />

    <AuthenticationCard>
        <template #logo>
            <div class="flex justify-between items-center">
                <div class="flex justify-start items-center space-x-2">
                    <AuthenticationCardLogo />
                    <p class="text-3xl"><b>Laravel</b> Jarvis</p>
                </div>
            </div>
        </template>
        <template #illustration>
            <p class="text-3xl"><b>Email</b> Verification</p>
            <AuntheticationIllustration type="login" class="w-72 h-auto" />
        </template>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Before continuing, could you verify your email address by clicking on the link we just emailed to you? If
            you didn't receive the email, we will gladly send you another.
        </div>

        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
            A new verification link has been sent to the email address you provided in your profile settings.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </PrimaryButton>

                <div>
                    <Link :href="route('profile.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900">
                    Edit Profile</Link>

                    <Link :href="route('logout')" method="post" as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 ml-2">
                    Log Out
                    </Link>
                </div>
            </div>
        </form>
    </AuthenticationCard>
</template>
