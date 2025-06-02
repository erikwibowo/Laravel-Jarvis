<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ActionButton from "@/Components/ActionButton.vue";
import { useForm } from "@inertiajs/vue3";
import { reactive, ref, onUpdated } from "vue";
import { PlusIcon, PencilIcon } from "@heroicons/vue/24/outline";
import Checkbox from "@/Components/Checkbox.vue";

const emit = defineEmits(["open"]);
const show = ref(false);
const props = defineProps({
    title: String,
    permissions: Object,
    role: Object,
    formSchema: { type: String, default: "create" },
});

const data = reactive({
    multipleSelect: false,
});

// default form
const form = useForm({
    name: "",
    guard_name: "web",
    permissions: [],
});

// if form schema is update/edit
onUpdated(() => {
    if (show && props.formSchema === "update") {
        form.name = props.role?.name;
        form.permissions = props.role?.permissions?.map((d) => d.id);
    }
    data.multipleSelect =
        props.permissions.reduce(
            (total, data) => total + data.data.length,
            0,
        ) === props.role?.permissions.length;
});

// submitting form
const submit = () => {
    if (props.formSchema === "create") {
        form.post(route("role.store"), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => null,
            onFinish: () => null,
        });
    } else {
        form.put(route("role.update", props.role?.id), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => null,
            onFinish: () => null,
        });
    }
};

// closing modal
const closeModal = () => {
    show.value = false;
    form.errors = {};
    form.reset();
    data.multipleSelect = false;
};

// add the logic method here
const selectAll = (event) => {
    if (event.target.checked === false) {
        form.permissions = [];
    } else {
        props.permissions.forEach((permission) => {
            permission.data.forEach((data) => {
                form.permissions.push(data.id);
            });
        });
    }
};
const select = () => {
    data.multipleSelect =
        props.permissions.reduce(
            (total, data) => total + data.data.length,
            0,
        ) === form.permissions.length;
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
                            :placeholder="lang().placeholder.role_name"
                            :error="form.errors.name"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel :value="lang().label.permissions" />
                        <InputError
                            class="mt-2"
                            :message="form.errors.permissions"
                        />
                        <div
                            class="flex justify-start items-center space-x-2 mt-2"
                        >
                            <Checkbox
                                id="permission-all"
                                v-model:checked="data.multipleSelect"
                                @change="selectAll"
                            />
                            <InputLabel
                                for="permission-all"
                                :value="lang().label.check_all"
                            />
                        </div>
                        <div
                            class="mt-2"
                            v-for="(permission, index) in props.permissions"
                            :key="index"
                        >
                            <p class="font-semibold text-primary capitalize">
                                {{ permission.group }}
                            </p>
                            <div class="flex flex-wrap gap-4 mt-1 mb-4">
                                <div
                                    class="flex items-center justify-start space-x-2"
                                    v-for="(
                                        permissiondata, index
                                    ) in permission.data"
                                    :key="index"
                                >
                                    <input
                                        @change="select"
                                        class="rounded-sm dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-xs focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox"
                                        :id="'permission_' + permissiondata.id"
                                        :value="permissiondata.id"
                                        v-model="form.permissions"
                                    />
                                    <InputLabel
                                        :for="'permission_' + permissiondata.id"
                                    >
                                        <p
                                            v-bind:class="
                                                permissiondata.name == 'delete'
                                                    ? 'text-red-500 font-semibold'
                                                    : ''
                                            "
                                        >
                                            {{ permissiondata.name }}
                                        </p>
                                    </InputLabel>
                                </div>
                            </div>
                        </div>
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
