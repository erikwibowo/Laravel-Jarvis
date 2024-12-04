<script setup>
import { Head } from "@inertiajs/vue3";
import BackToTop from "@/Components/BackToTop.vue";
import Toast from "@/Components/Toast.vue";
import Navbar from "@/Layouts/Guest/Navbar.vue";
import Footer from "@/Layouts/Guest/Footer.vue";
defineProps({
    title: String,
});
</script>

<template>
    <div>
        <Head :title="title" />
        <Toast :flash="$page.props.flash" />
        <div
            class="flex relative w-full min-h-screen bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-200 overflow-x-hidden"
        >
            <div class="w-full">
                <Navbar />
                <!-- Page Content -->
                <main class="text-slate-600 dark:text-slate-200">
                    <slot />
                    <BackToTop />
                </main>
                <Footer />
            </div>
        </div>
    </div>
</template>
