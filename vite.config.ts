import fs from 'fs';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import path from 'path';

const symlinkImages = ({ imagesPath }: { imagesPath: string }) => ({
  name: 'symlink-images',
  configureServer(server) {
    const buildPath = server.config.build.outDir;
    const publicImagesPath = path.resolve(buildPath, 'images');

    if (!fs.existsSync(buildPath)) {
      fs.mkdirSync(buildPath, { recursive: true });
    }

    // Remove existing path (symlink or directory)
    if (fs.existsSync(publicImagesPath)) {
      try {
        fs.rmSync(publicImagesPath, { recursive: true });
        console.log(`🗑️ Removed existing symlink or path: ${publicImagesPath}`);
      } catch (err) {
        console.error('❌ Failed to remove existing path:', err.message);
      }
    }

    // Create new symlink
    try {
      const fullImagesPath = path.resolve(server.config.root, imagesPath);
      fs.symlinkSync(fullImagesPath, publicImagesPath, 'dir');
      console.log(`✅ Symlink created: ${publicImagesPath} → ${fullImagesPath}`);
    } catch (err) {
      console.error('❌ Failed to create symlink:', err.message);
    }
  },
});

export default defineConfig({
  plugins: [
    tailwindcss(),
    laravel({
      input: ['resources/assets/css/index.css', 'resources/assets/ts/shop/index.ts'],
      refresh: true,
      buildDirectory: 'themes/shop/visual-debut',
      hotFile: 'public/themes/shop/visual-debut/visual-debut-vite.hot',
    }),
    symlinkImages({ imagesPath: 'resources/assets/images' }), // symlink images for dev
    viteStaticCopy({
      targets: [
        {
          src: 'resources/assets/images/*',
          dest: 'images',
        },
      ],
    }),
  ],
});
