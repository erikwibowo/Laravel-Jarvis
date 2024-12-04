import "./bootstrap";
import "../css/app.css";
import "floating-vue/dist/style.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { usePage } from "@inertiajs/vue3";
import FloatingVue from "floating-vue";
import Vue3Lottie from "vue3-lottie";
import "vue3-lottie/dist/style.css";
import JsonViewer from 'vue-json-viewer'

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${usePage().props.app.setting.name}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(FloatingVue)
            .use(Vue3Lottie)
            .use(JsonViewer)
            .mixin({
                methods: {
                    can: function (permissions) {
                        var allPermissions = this.$page.props.can;
                        var hasPermission = false;
                        permissions.forEach(function (item) {
                            if (allPermissions[item]) hasPermission = true;
                        });
                        return hasPermission;
                    },
                    lang: function () {
                        return usePage().props.app.language.original;
                    },
                    num(value) {
                        return new Intl.NumberFormat("id-ID").format(value);
                    },
                },
            })
            .mount(el);
    },
    progress: {
        color: "#00ba7c",
    },
});
