<script setup>
import { ref, computed, watch } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import ConfirmsPassword from '@/Components/ConfirmsPassword.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    requiresConfirmation: Boolean,
});

const enabling = ref(false);
const confirming = ref(false);
const disabling = ref(false);
const qrCode = ref(null);
const setupKey = ref(null);
const recoveryCodes = ref([]);

const confirmationForm = useForm({
    code: '',
});

const twoFactorEnabled = computed(
    () => !enabling.value && usePage().props.auth.user?.two_factor_enabled,
);

watch(twoFactorEnabled, () => {
    if (!twoFactorEnabled.value) {
        confirmationForm.reset();
        confirmationForm.clearErrors();
    }
});

const enableTwoFactorAuthentication = () => {
    enabling.value = true;

    router.post(route('two-factor.enable'), {}, {
        preserveScroll: true,
        onSuccess: () => Promise.all([
            showQrCode(),
            showSetupKey(),
            showRecoveryCodes(),
        ]),
        onFinish: () => {
            enabling.value = false;
            confirming.value = props.requiresConfirmation;
        },
    });
};

const showQrCode = () => {
    return axios.get(route('two-factor.qr-code')).then(response => {
        qrCode.value = response.data.svg;
    });
};

const showSetupKey = () => {
    return axios.get(route('two-factor.secret-key')).then(response => {
        setupKey.value = response.data.secretKey;
    });
}

const showRecoveryCodes = () => {
    return axios.get(route('two-factor.recovery-codes')).then(response => {
        recoveryCodes.value = response.data;
    });
};

const confirmTwoFactorAuthentication = () => {
    confirmationForm.post(route('two-factor.confirm'), {
        errorBag: "confirmTwoFactorAuthentication",
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            confirming.value = false;
            qrCode.value = null;
            setupKey.value = null;
        },
    });
};

const regenerateRecoveryCodes = () => {
    axios
        .post(route('two-factor.recovery-codes'))
        .then(() => showRecoveryCodes());
};

const disableTwoFactorAuthentication = () => {
    disabling.value = true;

    router.delete(route('two-factor.disable'), {
        preserveScroll: true,
        onSuccess: () => {
            disabling.value = false;
            confirming.value = false;
        },
    });
};
</script>

<template>
    <ActionSection>
        <template #title>
            {{ lang().label.two_factor_auth }}
        </template>

        <template #description>
            {{ lang().label.two_factor_auth_desctiption }}
        </template>

        <template #content>
            <h3 v-if="twoFactorEnabled && !confirming" class="text-lg font-medium text-slate-900 dark:text-slate-100">
                {{ lang().label.two_factor_auth_enabled }}
            </h3>

            <h3 v-else-if="twoFactorEnabled && confirming" class="text-lg font-medium text-slate-900 dark:text-slate-100">
                {{ lang().label.two_factor_auth_enabling }}
            </h3>

            <h3 v-else class="text-lg font-medium text-slate-900 dark:text-slate-100">
                {{ lang().label.two_factor_auth_not_enabled }}
            </h3>

            <div class="mt-3 max-w-xl text-sm text-slate-600 dark:text-slate-400">
                <p>
                    {{ lang().label.two_factor_auth_caption }}
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-slate-600 dark:text-slate-400">
                        <p v-if="confirming" class="font-semibold">
                            {{ lang().label.two_factor_auth_finish }}
                        </p>

                        <p v-else>
                            {{ lang().label.two_factor_auth_now_enabled }}
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode" />

                    <div v-if="setupKey" class="mt-4 max-w-xl text-sm text-slate-600 dark:text-slate-400">
                        <p class="font-semibold">
                            Setup Key: <span v-html="setupKey"></span>
                        </p>
                    </div>

                    <div v-if="confirming" class="mt-4">
                        <InputLabel for="code" :value="lang().label.code" />

                        <TextInput id="code" v-model="confirmationForm.code" type="text" name="code"
                            class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            placeholder="••••••" @keyup.enter="confirmTwoFactorAuthentication"
                            :error="confirmationForm.errors.code" />

                        <InputError :message="confirmationForm.errors.code" class="mt-2" />
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0 && !confirming">
                    <div class="mt-4 max-w-xl text-sm text-slate-600 dark:text-slate-400">
                        <p class="font-semibold">
                            {{ lang().label.two_factor_auth_recovery_code }}
                        </p>
                    </div>

                    <div
                        class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-slate-100 dark:bg-slate-900 rounded">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="!twoFactorEnabled">
                    <ConfirmsPassword @confirmed="enableTwoFactorAuthentication">
                        <PrimaryButton type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                            {{ lang().button.enable }} {{ enabling ? '...' : '' }}
                        </PrimaryButton>
                    </ConfirmsPassword>
                </div>

                <div v-else>
                    <ConfirmsPassword @confirmed="confirmTwoFactorAuthentication">
                        <PrimaryButton v-if="confirming" type="button" class="mr-3" :class="{ 'opacity-25': enabling }"
                            :disabled="enabling">
                            {{ lang().button.confirm }} {{ enabling ? '...' : '' }}
                        </PrimaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="regenerateRecoveryCodes">
                        <SecondaryButton v-if="recoveryCodes.length > 0 && !confirming" class="mr-3">
                            {{ lang().button.regenerate_recovery_codes }}
                        </SecondaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="showRecoveryCodes">
                        <SecondaryButton v-if="recoveryCodes.length === 0 && !confirming" class="mr-3">
                            {{ lang().button.show_recovery_codes }}
                        </SecondaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <SecondaryButton v-if="confirming" :class="{ 'opacity-25': disabling }" :disabled="disabling">
                            {{ lang().button.cancel }} {{ disabling ? '...' : '' }}
                        </SecondaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <DangerButton v-if="!confirming" :class="{ 'opacity-25': disabling }" :disabled="disabling">
                            {{ lang().button.disable }} {{ disabling ? '...' : '' }}
                        </DangerButton>
                    </ConfirmsPassword>
                </div>
            </div>
        </template>
    </ActionSection>
</template>
