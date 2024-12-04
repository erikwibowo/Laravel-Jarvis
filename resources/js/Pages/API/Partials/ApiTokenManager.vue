<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import ActionSection from '@/Components/ActionSection.vue';
import Checkbox from '@/Components/Checkbox.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    tokens: Array,
    availablePermissions: Array,
    defaultPermissions: Array,
});

const createApiTokenForm = useForm({
    name: '',
    permissions: props.defaultPermissions,
});

const updateApiTokenForm = useForm({
    permissions: [],
});

const deleteApiTokenForm = useForm({});

const displayingToken = ref(false);
const managingPermissionsFor = ref(null);
const apiTokenBeingDeleted = ref(null);

const createApiToken = () => {
    createApiTokenForm.post(route('api-tokens.store'), {
        preserveScroll: true,
        onSuccess: () => {
            displayingToken.value = true;
            createApiTokenForm.reset();
        },
    });
};

const manageApiTokenPermissions = (token) => {
    updateApiTokenForm.permissions = token.abilities;
    managingPermissionsFor.value = token;
};

const updateApiToken = () => {
    updateApiTokenForm.put(route('api-tokens.update', managingPermissionsFor.value), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (managingPermissionsFor.value = null),
    });
};

const confirmApiTokenDeletion = (token) => {
    apiTokenBeingDeleted.value = token;
};

const deleteApiToken = () => {
    deleteApiTokenForm.delete(route('api-tokens.destroy', apiTokenBeingDeleted.value), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (apiTokenBeingDeleted.value = null),
    });
};
</script>

<template>
    <div>
        <!-- Generate API Token -->
        <FormSection @submitted="createApiToken">
            <template #title>
                {{ lang().label.create_api_token }}
            </template>

            <template #description>
                {{ lang().label.create_api_token_caption }}
            </template>

            <template #form>
                <!-- Token Name -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" :value="lang().label.token_name" />
                    <TextInput id="name" v-model="createApiTokenForm.name" type="text" class="mt-1 block w-full" autofocus
                        :placeholder="lang().placeholder.token_name" :error="createApiTokenForm.errors.name" />
                    <InputError :message="createApiTokenForm.errors.name" class="mt-2" />
                </div>

                <!-- Token Permissions -->
                <div v-if="availablePermissions.length > 0" class="col-span-6">
                    <InputLabel for="permissions" :value="lang().label.permissions" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="permission in availablePermissions" :key="permission">
                            <label class="flex items-center">
                                <Checkbox v-model:checked="createApiTokenForm.permissions" :value="permission" />
                                <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">{{ permission }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </template>

            <template #actions>
                <ActionMessage :on="createApiTokenForm.recentlySuccessful" class="mr-3">
                    {{ lang().label.created }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': createApiTokenForm.processing }"
                    :disabled="createApiTokenForm.processing">
                    {{ lang().button.create }} {{ createApiTokenForm.processing ? '...' : '' }}
                </PrimaryButton>
            </template>
        </FormSection>

        <div v-if="tokens.length > 0">
            <SectionBorder />

            <!-- Manage API Tokens -->
            <div class="mt-10 sm:mt-0">
                <ActionSection>
                    <template #title>
                        {{ lang().label.manage_api_tokens }}
                    </template>

                    <template #description>
                        {{ lang().label.manage_api_tokens_caption }}
                    </template>

                    <!-- API Token List -->
                    <template #content>
                        <div class="space-y-6">
                            <div v-for="token in tokens" :key="token.id" class="flex items-center justify-between">
                                <div class="break-all dark:text-white">
                                    {{ token.name }}
                                </div>

                                <div class="flex items-center ml-2">
                                    <div v-if="token.last_used_ago" class="text-sm text-slate-400">
                                        {{ lang().label.last_used }} {{ token.last_used_ago }}
                                    </div>

                                    <button v-if="availablePermissions.length > 0"
                                        class="cursor-pointer ml-6 text-sm text-slate-400 underline"
                                        @click="manageApiTokenPermissions(token)">
                                        {{ lang().button.permissions }}
                                    </button>

                                    <button class="cursor-pointer ml-6 text-sm text-rose-500"
                                        @click="confirmApiTokenDeletion(token)">
                                        {{ lang().button.delete }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </ActionSection>
            </div>
        </div>

        <!-- Token Value Modal -->
        <DialogModal :show="displayingToken" @close="displayingToken = false">
            <template #title>
                {{ lang().label.api_token }}
            </template>

            <template #content>
                <div>
                    {{ lang().label.api_token_caption }}
                </div>

                <div v-if="$page.props.jetstream.flash.token"
                    class="mt-4 bg-slate-100 dark:bg-slate-900 px-4 py-2 rounded font-mono text-sm text-slate-500 break-all">
                    {{ $page.props.jetstream.flash.token }}
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="displayingToken = false">
                    {{ lang().button.close }}
                </SecondaryButton>
            </template>
        </DialogModal>

        <!-- API Token Permissions Modal -->
        <DialogModal :show="managingPermissionsFor != null" @close="managingPermissionsFor = null">
            <template #title>
                {{ lang().label.api_token_permissions }}
            </template>

            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="permission in availablePermissions" :key="permission">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="updateApiTokenForm.permissions" :value="permission" />
                            <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">{{ permission }}</span>
                        </label>
                    </div>
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="managingPermissionsFor = null">
                    {{ lang().button.cancel }}
                </SecondaryButton>

                <PrimaryButton class="ml-3" :class="{ 'opacity-25': updateApiTokenForm.processing }"
                    :disabled="updateApiTokenForm.processing" @click="updateApiToken">
                    {{ lang().button.save }} {{ updateApiTokenForm.processing ? '...' : '' }}
                </PrimaryButton>
            </template>
        </DialogModal>

        <!-- Delete Token Confirmation Modal -->
        <ConfirmationModal :show="apiTokenBeingDeleted != null" @close="apiTokenBeingDeleted = null">
            <template #title>
                {{ lang().label.delete_api_token }}
            </template>

            <template #content>
                {{ lang().label.delete_api_token_caption }}
            </template>

            <template #footer>
                <SecondaryButton @click="apiTokenBeingDeleted = null">
                    {{ lang().button.cancel }}
                </SecondaryButton>

                <DangerButton class="ml-3" :class="{ 'opacity-25': deleteApiTokenForm.processing }"
                    :disabled="deleteApiTokenForm.processing" @click="deleteApiToken">
                    {{ lang().button.delete }} {{ deleteApiTokenForm.processing ? '...' : '' }}
                </DangerButton>
            </template>
        </ConfirmationModal>
    </div>
</template>
