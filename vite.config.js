import { defineConfig } from "vite";
import { resolve } from "path";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    appType: "mpa",
    plugins: [
        laravel({
            input: [
                // App
                "resources/css/app.css",
                "resources/js/app.js",

                // Auth
                "resources/css/pages/auth/_auth.css",
                // "resources/js/pages/auth/_auth.js",

                // Landing
                "resources/css/pages/landing/_landing.css",
                "resources/js/pages/landing/_landing.js",

                /*
                |-------------------------
                | Panels / Admin
                |-------------------------
                */

                // Dashboard
                "resources/css/pages/panels/admin/dashboard/_dashboard.css",
                "resources/js/pages/panels/admin/dashboard/_dashboard.js",

                // Projects
                "resources/css/pages/panels/admin/projects/_projects.css",
                "resources/js/pages/panels/admin/projects/_projects.js",

                // Services
                "resources/css/pages/panels/admin/services/_services.css",
                "resources/js/pages/panels/admin/services/_services.js",

                // Contacts
                "resources/css/pages/panels/admin/contacts/_contacts.css",
                "resources/js/pages/panels/admin/contacts/_contacts.js",

                /*
                |-------------------------
                | Shared
                |-------------------------
                */
                "resources/css/pages/shared/settings/_settings.css",
                "resources/js/pages/shared/settings/_settings.js",

                // Site preview
                "resources/js/pages/shared/settings/site-editor/scripts/site-editor-preview.js",
            ],
            refresh: true,
        }),

        tailwindcss(),
    ],

    build: {
        emptyOutDir: true,
    },

    resolve: {
        alias: {
            "@": resolve(__dirname, "resources"),
            "@js": resolve(__dirname, "resources/js"),
            "@css": resolve(__dirname, "resources/css"),
            "@img": resolve(__dirname, "resources/assets/images"),
            "@videos": resolve(__dirname, "resources/assets/videos"),
            "@views": resolve(__dirname, "resources/views"),
        },
    },
});
