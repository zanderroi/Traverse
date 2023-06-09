import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/carimage.js',
                'resources/js/navbar.js',
                'resources/js/bookingcalendar.js',
                'resources/js/showpassword.js',
                'resources/js/popupmodal.js',
                'resources/js/avatar.js',
                'resources/js/bootstrap.js',
                'resources/js/track.js',
                'resources/js/wizardform.js',
            ],
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
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
