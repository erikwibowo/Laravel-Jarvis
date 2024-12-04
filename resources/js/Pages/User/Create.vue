<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import SelectInput from "@/Components/SelectInput.vue";
import { PlusIcon } from "@heroicons/vue/24/outline";

const show = ref(false);
const props = defineProps({
    title: String,
    roles: Object,
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: props.roles[1]?.name,
});

const submit = () => {
    form.post(route("user.store"), {
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
        <PrimaryButton
            class="flex rounded-none items-center justify-start gap-2"
            @click.prevent="show = true"
        >
            <PlusIcon class="w-4 h-auto" />
            <span class="hidden md:block">{{ lang().label.add }}</span>
        </PrimaryButton>
        <DialogModal :show="show" @close="closeModal">
            <template #title>
                {{ lang().label.add }} {{ props.title }}
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
