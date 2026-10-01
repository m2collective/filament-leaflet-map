import { resolve } from 'node:path'
import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        lib: {
            entry: resolve(import.meta.dirname, 'resources/js/filament-leaflet-map.js'),
            name: 'filament-leaflet-map',
            fileName: 'filament-leaflet-map'
        }
    },
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
            }
        }
    }
});
