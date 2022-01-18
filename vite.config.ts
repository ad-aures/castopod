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
        "podcast.ts": "js/podcast.ts",
        "install.ts": "js/install.ts",
        "app.ts": "js/app.ts",
        "admin.ts": "js/admin.ts",
        "charts.ts": "js/charts.ts",
        "map.ts": "js/map.ts",
        "audio-player.ts": "js/audio-player.ts",
        "embed.ts": "js/embed.ts",
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
