import "./bootstrap";
import "../css/app.css";
import "floating-vue/dist/style.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "ziggy-js";
import { usePage } from "@inertiajs/vue3";
import FloatingVue from "floating-vue";
import Vue3Lottie from "vue3-lottie";
import "vue3-lottie/dist/style.css";
import JsonViewer from "vue-json-viewer";
import GlobalMixin from "./Mixins/global";

const pages = import.meta.glob("./Pages/**/*.vue");

createInertiaApp({
    title: (title) =>
        title
            ? `${title} | ${usePage().props?.app?.setting?.short_name || "Laravel"}`
            : `${usePage().props?.app?.setting?.short_name || "Laravel"}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, pages),
    setup({ el, App, props, plugin }) {
        // ✅ Deklarasi `vueApp` terlebih dahulu sebelum mengakses `config.globalProperties`
        const vueApp = createApp({ render: () => h(App, props) });

        // ✅ Gunakan semua plugin & mixin sebelum mounting
        return vueApp
            .use(plugin)
            .use(ZiggyVue)
            .use(FloatingVue)
            .use(Vue3Lottie)
            .use(JsonViewer)
            .mixin(GlobalMixin)
            .mount(el);
    },
    progress: {
        color: "#00ba7c",
    },
});
