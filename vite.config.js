import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // tambahkan base untuk production
            // pakai APP_URL agar asset selalu HTTPS
            base: process.env.APP_URL + '/build/',
        }),
    ],
});
