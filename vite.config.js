import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',

                'resources/css/styles.css',
                'resources/js/scripts.js',

                'resources/assets/images/favicon.png',
                'resources/assets/images/profiles/profile-1.png',
            ],
            refresh: true,
        }),
    ],
    assetsInclude: ['**/*.png', '**/*.jpg', '**/*.svg'],
});
