import { fileURLToPath, URL } from 'node:url';

import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import mkcert from 'vite-plugin-mkcert';

export default defineConfig({
    plugins: [vue(), mkcert()],
    server: {
        https: true,
        port: 5173,
        strictPort: true,
        hmr: {
            protocol: 'wss',
            host: 'localhost',
            port: 5173
        }
    },
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url))
        }
    }
});
