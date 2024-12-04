<script setup>
import { nextTick, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};
</script>

<template>
    <Head :title="lang().label.two_factor_confirmation" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="flex flex-col mb-4">
            <h2 class="text-primary font-semibold text-xl">{{ lang().label.two_factor_confirmation }}</h2>
            <small class="text-slate-400">{{ lang().label.two_factor_confirmation_caption }}</small>
        </div>

        <div class="mb-4 text-sm text-slate-600 dark:text-slate-400">
            <template v-if="!recovery">
                {{ lang().label.please_confirm_access }}
            </template>

            <template v-else>
                {{ lang().label.please_confirm_access_recovery }}
            </template>
        </div>

        <form @submit.prevent="submit">
            <div v-if="!recovery">
                <InputLabel for="code" :value="lang().label.code" />
                <TextInput id="code" ref="codeInput" v-model="form.code" type="text" inputmode="numeric"
                    class="mt-1 block w-full" autofocus autocomplete="one-time-code" :placeholder="lang().placeholder.code"
                    :error="form.errors.code" />
                <InputError class="mt-2" :message="form.errors.code" />
            </div>

            <div v-else>
                <InputLabel for="recovery_code" :value="lang().label.recovery_code" />
                <TextInput id="recovery_code" ref="recoveryCodeInput" v-model="form.recovery_code" type="text"
                    class="mt-1 block w-full" autocomplete="one-time-code" :placeholder="lang().placeholder.recovery_code"
                    :error="form.errors.recovery_code" />
                <InputError class="mt-2" :message="form.errors.recovery_code" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="button"
                    class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 underline cursor-pointer"
                    @click.prevent="toggleRecovery">
                    <template v-if="!recovery">
                        {{ lang().label.use_recovery_code }}
                    </template>

                    <template v-else>
                        {{ lang().label.use_authentication_code }}
                    </template>
                </button>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ lang().button.login }} {{ form.processing ? '...' : '' }}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
