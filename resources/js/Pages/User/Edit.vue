<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ActionButton from "@/Components/ActionButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onUpdated } from "vue";
import SelectInput from "@/Components/SelectInput.vue";
import { PencilIcon } from "@heroicons/vue/24/outline";

const emit = defineEmits(["open"]);
const show = ref(false);
const props = defineProps({
    title: String,
    roles: Object,
    user: Object,
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "",
});

onUpdated(() => {
    if (show) {
        form.name = props.user?.name;
        form.email = props.user?.email;
        form.role = props.user?.roles == 0 ? "" : props.user?.roles[0].name;
    }
});

const submit = () => {
    form.put(route("user.update", props.user?.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => null,
        onFinish: () => null,
    });
};

const closeModal = () => {
    show.value = false;
    form.errors = {};
    form.reset();
};

const roles = props.roles?.map((role) => ({
    label: role.name,
    value: role.name,
}));
</script>
<template>
    <div>
        <ActionButton
            v-tooltip="lang().label.edit"
            @click.prevent="(show = true), emit('open')"
        >
            <PencilIcon class="w-4 h-auto" />
        </ActionButton>
        <DialogModal :show="show" @close="closeModal">
            <template #title>
                {{ lang().label.edit }} {{ props.title }}
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
                            :placeholder="lang().placeholder.name"
                            :error="form.errors.name"
                            @keyup.enter="submit"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="email" :value="lang().label.email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="block w-full"
                            :placeholder="lang().placeholder.email"
                            :error="form.errors.email"
                            @keyup.enter="submit"
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="password"
                            :value="lang().label.password"
                        />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="block w-full"
                            :placeholder="lang().placeholder.password"
                            :error="form.errors.password"
                            @keyup.enter="submit"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="password_confirmation"
                            :value="lang().label.password_confirmation"
                        />
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="block w-full"
                            :placeholder="lang().placeholder.password"
                            :error="form.errors.password_confirmation"
                            @keyup.enter="submit"
                        />
                        <InputError
                            :message="form.errors.password_confirmation"
                        />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="role" :value="lang().label.role" />
                        <SelectInput
                            id="role"
                            v-model="form.role"
                            :dataSet="roles"
                            class="block w-full"
                            :error="form.errors.role"
                        />
                        <InputError :message="form.errors.role" />
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    {{ lang().button.cancel }}
                </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="submit"
                >
                    {{ lang().button.save }} {{ form.processing ? "..." : "" }}
                </PrimaryButton>
            </template>
        </DialogModal>
    </div>
</template>
