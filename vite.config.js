import { defineConfig } from "vite";
import { resolve } from "path";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    appType: "mpa",
    plugins: [
        laravel({
            input: [
                // -- App
                "resources/css/app.css",
                "resources/js/app.js",

                // -- Landing
                "resources/css/pages/landing/_landing.css",
                "resources/js/pages/landing/_landing.js",
            ],
            refresh: true,
        }),

        tailwindcss(),
    ],

    build: {
        emptyOutDir: true,
        rollupOptions: {},
    },

    resolve: {
        alias: {
            "@": resolve(__dirname, "resources"),

            "@js": resolve(__dirname, "resources/js"),
            "@css": resolve(__dirname, "resources/css"),

            "@js_pages": resolve(__dirname, "resources/js/pages"),
            "@css_pages": resolve(__dirname, "resources/css/pages"),

            "@js_admin": resolve(__dirname, "resources/js/pages/panels/admin"),
            "@css_admin": resolve( __dirname, "resources/css/pages/panels/admin"),

            "@js_user": resolve(__dirname, "resources/js/pages/panels/user"),
            "@css_user": resolve(__dirname, "resources/css/pages/panels/user"),

            "@js_guest": resolve(__dirname, "resources/js/pages/guest"),
            "@css_guest": resolve(__dirname, "resources/css/pages/guest"),

            "@img": resolve(__dirname, "resources/assets/images"),
            "@vidoes": resolve(__dirname, "resources/audio"),
            "@json": resolve(__dirname, "resources/json"),
            "@views": resolve(__dirname, "resources/views"),
        },
    },
});
