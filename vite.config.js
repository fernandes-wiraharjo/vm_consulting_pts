import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 'resources/js/app.js',

                'resources/js/role/index.js',
                'resources/js/user/index.js',
                'resources/js/user-rate/index.js',
                'resources/js/client/index.js',
            ],
            refresh: true,
        }),
    ],
});
