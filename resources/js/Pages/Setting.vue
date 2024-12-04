<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import ImageInput from "@/Components/ImageInput.vue";

const props = defineProps({
    title: String,
    setting: Object,
});

const form = useForm({
    favicon: null,
    logo: null,
    name: props.setting?.name,
    short_name: props.setting?.short_name,
    description: props.setting?.description,
    _method: "PUT",
});
const update = () => {
    form.post(route("setting.update", props.setting?.id), {
        preserveScroll: true,
        onSuccess: () => null,
        onError: () => null,
        onFinish: () => null,
    });
};

const fileChange = (value) => {
    if (value.source === "favicon") {
        form.favicon = value.file;
    } else if (value.source === "logo") {
        form.logo = value.file;
    }
};
</script>

<template>
    <AppLayout :title="props.title">
        <template #title>
            <span>{{ props.title }}</span>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection>
                    <template #title> {{ lang().label.web_setting }} </template>

                    <template #description>
                        {{ lang().label.web_setting_description }}
                    </template>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="favicon" value="Favicon" />
                            <ImageInput
                                source="favicon"
                                v-model="form.favicon"
                                :image="props.setting.full_path_favicon"
                                tooltip="Click to select/change favicon"
                                class="mt-1 block w-14 h-14"
                                @fileChange="fileChange"
                            />
                            <InputError
                                :message="form.errors.favicon"
                                class="mt-2"
                            />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="logo" value="Logo" />
                            <ImageInput
                                source="logo"
                                v-model="form.logo"
                                :image="props.setting.full_path_logo"
                                tooltip="Click to select/change logo"
                                class="mt-1 block w-24 h-24"
                                @fileChange="fileChange"
                            />
                            <InputError
                                :message="form.errors.logo"
                                class="mt-2"
                            />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="name" :value="lang().label.name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                :placeholder="lang().placeholder.name"
                                :error="form.errors.name"
                            />
                            <InputError
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel
                                for="short_name"
                                :value="lang().label.short_name"
                            />
                            <TextInput
                                id="short_name"
                                v-model="form.short_name"
                                type="text"
                                class="mt-1 block w-full"
                                :placeholder="lang().placeholder.short_name"
                                :error="form.errors.short_name"
                            />
                            <InputError
                                :message="form.errors.short_name"
                                class="mt-2"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel
                                for="description"
                                :value="lang().label.description"
                            />
                            <TextAreaInput
                                id="description"
                                rows="4"
                                v-model="form.description"
                                class="mt-1 block w-full"
                                :placeholder="lang().placeholder.description"
                                :error="form.errors.description"
                            />
                            <InputError
                                :message="form.errors.description"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage
                            :on="form.recentlySuccessful"
                            class="mr-3"
                        >
                            {{ lang().label.saved }}
                        </ActionMessage>

                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="update"
                        >
                            {{ lang().button.save }}
                            {{ form.processing ? "..." : "" }}
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
