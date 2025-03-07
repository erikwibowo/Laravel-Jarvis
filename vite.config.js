import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],

    /**
     * This line is for prevent CORS error when developing environment
     * Change with your local development domain
     * In this case, I'm using http://jarvis.test provided by Laragon
     * If you're using Valet, you can use http://jarvis.test
     * Or if you're using XAMPP, you can use http://localhost:your-port (default is 80)
     */
    server: {
        cors: {
            origin: ["http://laravel-jarvis.test"],
        },
    },
});
