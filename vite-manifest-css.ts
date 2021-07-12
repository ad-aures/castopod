// This plugin adds a `manifest-css.json` file for css assets to help reference them from the backend
// Adapted from https://github.com/ElMassimo/vite_ruby/blob/main/vite-plugin-ruby/src/manifest.ts

import path from "path";
import { OutputBundle } from "rollup";
import type { Plugin, ResolvedConfig } from "vite";

interface AssetsManifestChunk {
  src?: string;
  file: string;
}

type AssetsManifest = Map<string, AssetsManifestChunk>;

// Internal: Returns the filename without the last extension.
function withoutExtension(filename: string) {
  return filename.substr(0, filename.lastIndexOf("."));
}

// Internal: Writes a manifest file that allows to map an entrypoint asset file
// name to the corresponding output file name.
export function ManifestCSS(): Plugin {
  let config: ResolvedConfig;

  // Internal: For stylesheets Vite does not output the result to the manifest,
  // so we extract the file name of the processed asset from the Rollup bundle.
  function extractChunkStylesheets(
    bundle: OutputBundle,
    manifest: AssetsManifest
  ) {
    const cssFiles = new Set(
      Object.values(config.build.rollupOptions.input as Record<string, string>)
        .filter((file) => new RegExp(`\\.css$`).test(file))
        .map((file) => path.relative(config.root, file))
    );

    Object.values(bundle)
      .filter((chunk) => chunk.type === "asset" && chunk.name)
      .forEach((chunk) => {
        // NOTE: Rollup appends `.css` to the file so it's removed before matching.
        // See `resolveEntrypointsForRollup`.
        const src = withoutExtension(chunk.name!);
        if (cssFiles.has(src)) {
          manifest.set(src, { file: chunk.fileName, src });
        }
      });
  }

  return {
    name: "vite-assets-manifest",
    apply: "build",
    enforce: "post",
    configResolved(resolvedConfig: ResolvedConfig) {
      config = resolvedConfig;
    },
    async generateBundle(_options, bundle) {
      const manifest: AssetsManifest = new Map();
      extractChunkStylesheets(bundle, manifest);

      this.emitFile({
        fileName: "manifest-css.json",
        type: "asset",
        source: JSON.stringify(Object.fromEntries(manifest), null, 2),
      });
    },
  };
}
