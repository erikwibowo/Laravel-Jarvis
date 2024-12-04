<script setup></script>
<template>
    <footer class="sticky top-[100vh]">
        <div
            class="bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800"
        >
            <div
                class="max-w-7xl mx-auto flex justify-end items-center px-4 sm:px-6 lg:px-8 py-4"
            >
                <p class="text-slate-600 dark:text-slate-400">
                    {{
                        $page.props.app.setting.name +
                        " v." +
                        $page.props.app.version
                    }}
                    &copy; 2023-{{ new Date().getFullYear() }}.
                    {{ lang().label.build_with }}
                    <span class="text-rose-500">♥️</span> {{ lang().label.by }}
                    <a
                        class="text-primary font-semibold"
                        target="_blank"
                        href="https://erikwibowo.com"
                        >Erik Wibowo</a
                    >
                </p>
            </div>
        </div>
    </footer>
</template>
