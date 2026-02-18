import path from "path";
import { defineConfig } from "vite";
import codeigniter from "vite-plugin-codeigniter";
import { VitePWA } from "vite-plugin-pwa";

// https://vitejs.dev/config/
export default defineConfig({
  server: {
    host: true,
    port: 5173,
    strictPort: true,
  },
  plugins: [
    codeigniter({
      imageVariants: [
        {
          src: "images/castopod-banner-*.jpg",
          sizes: {
            "%NAME%_small.webp": 320,
            "%NAME%_medium.webp": 960,
            "%NAME%_federation.jpg": 1500,
          },
        },
        {
          src: "images/castopod-avatar.jpg",
          sizes: {
            "%NAME%_tiny.webp": 40,
            "%NAME%_thumbnail.webp": 150,
            "%NAME%_medium.webp": 320,
            "%NAME%_federation.jpg": 400,
          },
        },
      ],
    }),
    VitePWA({
      manifest: false,
      outDir: path.resolve(__dirname, "public/assets"),
    }),
  ],
});
