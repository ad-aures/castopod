import { defineConfig } from "vite";
import { VitePWA } from "vite-plugin-pwa";
import { ManifestCSS } from "./vite-manifest-css";

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
        "admin-audio-player.ts": "js/admin-audio-player.ts",
        "admin.ts": "js/admin.ts",
        "app.ts": "js/app.ts",
        "audio-player.ts": "js/audio-player.ts",
        "charts.ts": "js/charts.ts",
        "embed.ts": "js/embed.ts",
        "install.ts": "js/install.ts",
        "map.ts": "js/map.ts",
        "podcast.ts": "js/podcast.ts",
        "styles/index.css": "styles/index.css",
      },
    },
  },
  plugins: [
    ManifestCSS(),
    VitePWA({
      manifest: false,
      outDir: "../../public",
    }),
  ],
});
