import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/modules/form-add.js",
                "resources/js/modules/form-edit.js",
                "resources/js/tabs.js",
            ],
            refresh: true,
        }),
    ],
});
