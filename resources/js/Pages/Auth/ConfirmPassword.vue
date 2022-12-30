<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuntheticationIllustration from '@/Components/AuntheticationIllustration.vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>

    <Head title="Secure Area" />

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
            <p class="text-3xl"><b>Confirm</b> Password</p>
            <AuntheticationIllustration type="login" class="w-72 h-auto" />
        </template>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="mt-1 block w-full" required autocomplete="current-password" autofocus placeholder="********" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirm
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
