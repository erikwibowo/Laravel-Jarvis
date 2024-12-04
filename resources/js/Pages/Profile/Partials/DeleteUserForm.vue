<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            {{ lang().label.delete_account }}
        </template>

        <template #description>
            {{ lang().label.delete_account_description }}
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-slate-600 dark:text-slate-400">
                {{ lang().label.delete_account_content }}
            </div>

            <div class="mt-5">
                <DangerButton @click="confirmUserDeletion">
                    {{ lang().button.delete_account }}
                </DangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    {{ lang().label.delete_account }}
                </template>

                <template #content>
                    {{ lang().label.delete_account_confirm }}

                    <div class="mt-4">
                        <TextInput ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full"
                            placeholder="Password" autocomplete="current-password" @keyup.enter="deleteUser"
                            :error="form.errors.password" />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        {{ lang().button.cancel }}
                    </SecondaryButton>

                    <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteUser">
                        {{ lang().button.delete_account }} {{ form.processing ? '...' : '' }}
                    </DangerButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
