import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/all.min.css','resources/css/output.css', 'resources/js/main.js'],
            refresh: true,
        }),
    ],
});
