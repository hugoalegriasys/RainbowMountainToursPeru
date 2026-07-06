import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin'
import { wordpressPlugin, wordpressThemeJson } from '@roots/vite-plugin';

// 1. Apuntar a la URL real de tu XAMPP
if (! process.env.APP_URL) {
  process.env.APP_URL = 'http://localhost/mi-sitio/wordpress';
}

export default defineConfig({
  // 2. Corregir la ruta base para WordPress clásico en XAMPP
  base: '/mi-sitio/wordpress/wp-content/themes/mi-tema/public/build/',
  
  plugins: [
    tailwindcss(),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/editor.css',
        'resources/js/editor.js',
      ],
      refresh: true,
      assets: ['resources/images/**', 'resources/fonts/**'],
    }),

    wordpressPlugin(),

    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
      disableTailwindBorderRadius: false,
    }),
  ],
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
  
  // 3. Asegurar que Vite permita inyectar los assets en el servidor de XAMPP (CORS)
  server: {
    host: 'localhost',
    cors: true,
  },
})