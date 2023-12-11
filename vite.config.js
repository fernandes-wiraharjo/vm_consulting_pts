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
                'resources/js/project-tracking/index.js',
                'resources/js/project-tracking/detail/job.js',
                'resources/js/project-tracking/detail/user.js',
                'resources/js/project-tracking/detail/user-edit.js',
                'resources/js/daily-task/index.js',
                'resources/js/daily-task/create.js',
                'resources/js/daily-task/detail.js',
            ],
            refresh: true,
        }),
    ],
});
