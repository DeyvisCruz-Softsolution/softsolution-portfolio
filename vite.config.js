import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: 'public/build', // 👈 garantiza que los archivos se guarden donde Laravel los busca
        manifest: true,         // 👈 necesario para modo production
        emptyOutDir: true,      // limpia la carpeta antes de generar los nuevos archivos
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
