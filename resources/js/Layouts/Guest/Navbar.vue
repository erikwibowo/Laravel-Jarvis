<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavbarLink from "@/Components/Guest/NavbarLink.vue";
import SwitchDarkMode from "@/Components/SwitchDarkMode.vue";
import { Bars3BottomRightIcon } from "@heroicons/vue/24/outline";
import { reactive } from "vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";

const data = reactive({
    isOpen: false,
    fixed: false,
});

window.addEventListener("scroll", () => {
    let scrollPos = window.scrollY;
    if (scrollPos > 0) {
        data.fixed = true;
    } else {
        data.fixed = false;
    }
});
</script>
<template>
    <header
        v-bind:class="
            data.fixed || data.isOpen
                ? 'bg-white/70 dark:bg-slate-900/70 backdrop-blur-lg border-b border-slate-300/50 dark:border-slate-700/50'
                : 'border-none'
        "
        class="w-full fixed text-slate-600 dark:text-slate-200 z-50"
    >
        <div
            class="flex flex-col max-w-7xl px-4 mx-auto sm:items-center sm:justify-between sm:flex-row sm:px-6 lg:px-8 py-2"
        >
            <div class="flex items-center justify-between">
                <div>
                    <Link
                        :href="route('index')"
                        class="shrink-0 flex w-full justify-start items-center space-x-4"
                    >
                        <ApplicationLogo class="block h-8 w-auto" />
                        <p
                            class="text-lg font-semibold uppercase tracking-widest"
                        >
                            {{ $page.props.app.setting.name }}
                        </p>
                    </Link>
                </div>
                <div class="sm:hidden">
                    <SwitchDarkMode />
                    <button
                        @click="data.isOpen = !data.isOpen"
                        class="inline-flex items-center justify-center p-2 rounded text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out"
                    >
                        <Bars3BottomRightIcon
                            v-if="!data.isOpen"
                            class="w-6 h-auto"
                        />
                        <XMarkIcon v-else class="w-6 h-auto" />
                    </button>
                </div>
            </div>
            <nav
                :class="data.isOpen ? '' : 'hidden'"
                class="relative sm:flex items-center space-y-2 sm:space-y-0 gap-2 py-4 sm:py-0"
            >
                <NavbarLink
                    v-bind:class="
                        route().current('index') ? 'font-bold text-primary' : ''
                    "
                    :href="route('index')"
                    label="Home"
                />
                <NavbarLink
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    label="Dashboard"
                />
                <template v-else>
                    <NavbarLink
                        v-if="route().has('login')"
                        :href="route('login')"
                        label="Login"
                    />
                    <NavbarLink
                        v-if="route().has('register')"
                        :href="route('register')"
                        label="Register"
                    />
                </template>
                <SwitchDarkMode class="hidden sm:block" />
            </nav>
        </div>
    </header>
</template>
