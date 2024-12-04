<script setup>
import { Head } from "@inertiajs/vue3";
import Toast from "@/Components/Toast.vue";
import Navbar from "./Authenticated/Navbar.vue";
import Footer from "./Authenticated/Footer.vue";
import Sidebar from "./Authenticated/Sidebar.vue";
import { ref } from "vue";
import Banner from "../Components/Banner.vue";
const showingSideBar = ref(false);
defineProps({
    title: String,
});
</script>

<template>
    <div>
        <Head :title="title" />
        <Toast :flash="$page.props.flash" />
        <Banner />
        <div
            class="flex relative w-full min-h-screen bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-slate-100 overflow-x-hidden text-base"
        >
            <Sidebar :open="showingSideBar" @close="showingSideBar = false" />
            <div class="pl-0 md:pl-64 w-full">
                <Navbar
                    :sidebarShow="showingSideBar"
                    @open="showingSideBar = true"
                >
                    <slot name="title" />
                    <slot name="breadcrumb" />
                </Navbar>
                <!-- Page Content -->
                <main class="pt-16">
                    <slot />
                </main>
                <Footer />
            </div>
        </div>
    </div>
</template>
