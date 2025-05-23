<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ActionButton from "@/Components/ActionButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onUpdated } from "vue";
import { PlusIcon, PencilIcon } from "@heroicons/vue/24/outline";

const emit = defineEmits(["open"]);
const show = ref(false);

const props = defineProps({
    title: String,
    formSchema: { type: String, default: "create" },
    roles: Object,
    permission: Object,
});

// default form
const form = useForm({
    name: "",
    guard_name: "web",
});

// if form schema is update/edit
onUpdated(() => {
    if (show && props.formSchema === "update") {
        form.name = props.permission?.name;
    }
});

// submitting form
const submit = () => {
    if (props.formSchema === "create") {
        form.post(route("permission.store"), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => null,
            onFinish: () => null,
        });
    } else {
        form.put(route("permission.update", props.permission?.id), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => null,
            onFinish: () => null,
        });
    }
};

// closing modal func
const closeModal = () => {
    show.value = false;
    form.errors = {};
    form.reset();
};
</script>

<template>
    <div>
        <!-- Trigger Button -->
        <PrimaryButton
            v-if="formSchema === 'create'"
            class="flex items-center gap-2"
            @click.prevent="show = true"
        >
            <PlusIcon class="w-4" />
            <span class="hidden md:block">{{ lang().label.add }}</span>
        </PrimaryButton>

        <ActionButton
            v-else
            v-tooltip="lang().label.edit"
            @click.prevent="((show = true), emit('open'))"
        >
            <PencilIcon class="w-4" />
        </ActionButton>

        <!-- Modal Form -->
        <DialogModal :show="show" @close="closeModal">
            <template #title>
                {{
                    formSchema === "create"
                        ? lang().label.add
                        : lang().label.edit
                }}
                {{ title }}
            </template>

            <template #content>
                <form class="space-y-2" @submit.prevent="submit">
                    <div class="space-y-1">
                        <InputLabel for="name" :value="lang().label.name" />
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="block w-full"
                            autocomplete="name"
                            :placeholder="lang().placeholder.permission_name"
                            :error="form.errors.name"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                </form>
            </template>

            <template #footer>
                <div class="flex gap-4">
                    <SecondaryButton @click="closeModal">
                        {{ lang().button.cancel }}
                    </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="submit"
                    >
                        {{ lang().button.save }}
                        {{ form.processing ? "..." : "" }}
                    </PrimaryButton>
                </div>
            </template>
        </DialogModal>
    </div>
</template>

<style scoped></style>
