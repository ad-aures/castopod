import { defineConfig } from "vite";
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
        "podcast.ts": "app/Resources/js/podcast.ts",
        "install.ts": "app/Resources/js/install.ts",
        "app.ts": "app/Resources/js/app.ts",
        "admin.ts": "app/Resources/js/admin.ts",
        "charts.ts": "app/Resources/js/charts.ts",
        "map.ts": "app/Resources/js/map.ts",
        "audio-player.ts": "app/Resources/js/audio-player.ts",
        "embed.ts": "app/Resources/js/embed.ts",
        "styles/index.css": "app/Resources/styles/index.css",
      },
    },
  },
  plugins: [ManifestCSS()],
});
