import { defineConfig } from 'vite';
import path from 'path';
import fs from 'fs';

const pagesDir = path.resolve(__dirname, 'src/pages');
const pages = fs.readdirSync(pagesDir).filter(file => file.endsWith('.ts'));

const input = Object.fromEntries(
  pages.map(file => [
    file.replace('.ts', ''),
    path.resolve(pagesDir, file)
  ])
);

input.main = 'E:\\VPN\\www\\flowers_shop\\src\\main.ts'


export default defineConfig({
  server: { cors: true },
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input, // ← автоматически все .ts файлы из pages
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/chunks/[name]-[hash].js'
      }
    },
    target: 'esnext',
    minify: 'esbuild',
    treeshake: true
  }
});
