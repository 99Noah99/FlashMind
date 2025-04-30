import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx'
            ],
            refresh: true,
        }),
        tailwindcss(),
        react(),
    ],

    resolve: {
        alias: {
            '@': '/resources/js',
            '@components': '/resources/js/Components',
            '@pages': '/resources/js/Pages',
            '@styles': '/resources/css',
        }
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost', // spécifier que le conteneur pour communiquer avec le conteneur vite
        },
    },
});
