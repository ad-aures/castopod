import { defineConfig } from "vite";
import { VitePWA } from "vite-plugin-pwa";

// https://vitejs.dev/config/
export default defineConfig({
  root: "./app/Resources",
  base: "/assets/",
  build: {
    outDir: "../../public/assets",
    assetsDir: "",
    manifest: true,
    sourcemap: true,
    rollupOptions: {
      input: {
        "admin-audio-player.ts": "app/Resources/js/admin-audio-player.ts",
        "admin.ts": "app/Resources/js/admin.ts",
        "app.ts": "app/Resources/js/app.ts",
        "audio-player.ts": "app/Resources/js/audio-player.ts",
        "charts.ts": "app/Resources/js/charts.ts",
        "embed.ts": "app/Resources/js/embed.ts",
        "error.ts": "app/Resources/js/error.ts",
        "install.ts": "app/Resources/js/install.ts",
        "map.ts": "app/Resources/js/map.ts",
        "podcast.ts": "app/Resources/js/podcast.ts",
        "styles/index.css": "app/Resources/styles/index.css",
      },
    },
  },
  plugins: [
    VitePWA({
      manifest: false,
      outDir: "../../public",
    }),
  ],
});
