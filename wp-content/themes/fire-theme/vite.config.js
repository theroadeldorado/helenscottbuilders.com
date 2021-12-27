// View your website at your own local server
// for example http://vite-php-setup.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty
// TIP: consider changing the port for each project, see below

// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev:
// ln -s {path_to_vite}/src/assets {path_to_public_html}/assets
// on production everything will work just fine

import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import path from 'path';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    liveReload([
      // edit live reload paths according to your source code
      // for example:
      __dirname + '/**/*.php',
      // using this for our example:
      __dirname + './*.php',
    ]),
  ],
  base: process.env.APP_ENV === 'development' ? '/' : '/dist/',
  server: {
    proxy: {
      '/': {
        target: 'http://helenscottbuilders.fire/',
        changeOrigin: true,
      }
    },
    https: true,
    port: 3000,
    strictPort: true,
    cors: true,
  },
  build: {
    outDir: path.resolve(__dirname, './dist'),
    emptyOutDir: true,
    assetsDir: path.resolve(__dirname, '../assets'),
    manifest: true,
    rollupOptions: {
      input: path.resolve(__dirname, './theme/main.js'),
    },
  },
  css: {
    postcss: {
      plugins: {
        tailwindcss: {},
        autoprefixer: {},
      },
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, '.'),
      '@component': path.resolve(__dirname, 'theme/assets/scripts/components'),
      '@utility': path.resolve(__dirname, 'theme/assets/scripts/utilities'),
      '@font': path.resolve(__dirname, 'theme/assets/fonts'),
      '@template': path.resolve(__dirname, 'templates'),
    },
  },
});

//  plugins: [
//     liveReload([
//       // edit live reload paths according to your source code
//       // for example:
//       __dirname + '/(app|config|views)/**/*.php',
//       // using this for our example:
//       __dirname + './*.php',
//     ]),
//   ],

//   // config
//   root: 'src',
//   base: process.env.APP_ENV === 'development' ? '/' : '/dist/',

//   build: {
//     // output dir for production build
//     outDir: path.resolve(__dirname, './dist'),
//     emptyOutDir: true,

//     // emit manifest so PHP can find the hashed files
//     manifest: true,

//     // our entry
//     rollupOptions: {
//       input: path.resolve(__dirname, './theme/main.js'),
//     },
//   },

//   server: {
//     // required to load scripts from custom host
//     cors: true,

//     // we need a strict port to match on PHP side
//     // change freely, but update on PHP to match the same port
//     strictPort: true,
//     port: 3000,
//   },
