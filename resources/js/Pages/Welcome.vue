<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import SwitchDarkMode from "@/Components/SwitchDarkMode.vue";
import SwitchLocale from "@/Components/SwitchLocale.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head :title="lang().label.welcome" />
    <div
        class="relative flex justify-center items-center min-h-screen bg-dots-darker bg-center bg-slate-100 dark:bg-dots-lighter dark:bg-slate-900 selection:bg-primary selection:text-white text-slate-900 dark:text-white"
    >
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="mt-16">
                <div
                    class="grid grid-cols-1 scale-100 p-6 bg-white dark:bg-slate-800/50 dark:bg-gradient-to-bl from-slate-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded shadow-2xl shadow-slate-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-primary max-w-xl"
                >
                    <div class="flex items-center justify-between">
                        <Link
                            :href="'/'"
                            class="flex justify-items-start items-center space-x-2"
                        >
                            <ApplicationLogo class="w-10 h-auto" />
                            <p class="block text-xl font-semibold truncate text-slate-500 dark:text-slate-100">
                                {{ $page.props.app.setting.name }}
                            </p>
                        </Link>
                        <div class="flex justify-between items-center gap-1">
                            <SwitchLocale />
                            <SwitchDarkMode />
                        </div>
                    </div>
                    <div>
                        <a
                            target="_blank"
                            href="https://github.com/erikwibowo/Laravel-Jarvis.git"
                            class="block mt-6 text-xl font-semibold text-primary"
                            >{{ lang().label.documentation }}</a
                        >
                        <p
                            class="mt-4 text-slate-500 dark:text-slate-400 text-sm leading-relaxed"
                        >
                            {{ lang().label.documentation_long }}
                        </p>
                        <div v-if="canLogin" class="my-4 text-left">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('dashboard')"
                                class="font-semibold text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded focus:outline-primary"
                            >
                                {{ lang().label.dashboard }}</Link
                            >

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="font-semibold text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded focus:outline-primary"
                                >
                                    {{ lang().label.login }}</Link
                                >

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="ml-4 font-semibold text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded focus:outline-primary"
                                >
                                    {{ lang().label.register }}</Link
                                >
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="flex flex-col md:flex-row items-center mt-8 justify-between gap-2"
            >
                <div
                    class="ml-4 text-center text-sm text-slate-500 dark:text-slate-400 sm:text-right sm:ml-0"
                >
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
                <div
                    class="text-center text-sm text-slate-500 dark:text-slate-400 sm:text-left"
                >
                    <div class="flex items-center gap-4">
                        <p class="text-slate-600 dark:text-slate-400">
                            {{
                                $page.props.app.setting.name +
                                " v." +
                                $page.props.app.version
                            }}
                            &copy; {{ new Date().getFullYear() }}.
                            {{ lang().build_with }}
                            <span class="text-rose-500">♥️</span>
                            {{ lang().label.by }}
                            <a
                                class="text-primary font-semibold"
                                target="_blank"
                                href="https://erikwibowo.com"
                                >Erik Wibowo</a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
