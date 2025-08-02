import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'node_modules/morris.js/morris.css',
                'node_modules/raphael/raphael.min.js',
                'node_modules/morris.js/morris.min.js',
            ],
            refresh: true,
        }),
    ],
});
