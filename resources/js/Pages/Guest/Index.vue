<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    title: String,
});
</script>
<template>
    <GuestLayout :title="props.title">
        <section
            class="min-h-[calc(100vh)] bg-pattern grid place-items-center bg-pattern"
            id="home"
        >
            <div
                data-aos="fade-up"
                data-aos-duration="1000"
                class="grid grid-cols-1 text-center gap-4 py-8 max-w-7xl m-auto px-4 sm:px-6 lg:px-8"
            >
                <div class="place-self-center space-y-6">
                    <h1
                        class="text-4xl font-semibold tracking-tight leading-none md:text-5xl xl:text-6xl"
                    >
                        {{ $page.props.app.setting.name.split(" ")[0] }}
                        <span class="text-primary">{{
                            $page.props.app.setting.name.split(" ")[1]
                        }}</span>
                    </h1>
                    <blockquote
                        class="font-light max-w-4xl sm:text-lg md:text-xl"
                    >
                        {{ $page.props.app.setting.description }}
                    </blockquote>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
