<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuntheticationIllustration from '@/Components/AuntheticationIllustration.vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Reset Password" />

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
            <p class="text-3xl"><b>Reset</b> Password</p>
            <AuntheticationIllustration type="login" class="w-72 h-auto" />
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" placeholder="email@email.com" required autofocus />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                    autocomplete="new-password" placeholder="********" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="mt-1 block w-full" required autocomplete="new-password" placeholder="********" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
