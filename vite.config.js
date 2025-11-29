import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/group-booking.css',
                'resources/js/app.js',
                'resources/js/contact.js',
                'resources/js/flight-search.js',
                'resources/js/group-booking.js',
            ],
            refresh: true,
        }),
    ],
});
