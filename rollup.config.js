import babel from "@rollup/plugin-babel";
import commonjs from "@rollup/plugin-commonjs";
import json from "@rollup/plugin-json";
import resolve from "@rollup/plugin-node-resolve";
import multiInput from "rollup-plugin-multi-input";
import nodePolyfills from "rollup-plugin-node-polyfills";
import postcss from "rollup-plugin-postcss";
import { terser } from "rollup-plugin-terser";

const INPUT_DIR = "app/Views/_assets";
const OUTPUT_DIR = "public/assets";

export default {
  input: [`${INPUT_DIR}/*.ts`, `!${INPUT_DIR}/*.d.ts`],
  output: {
    dir: OUTPUT_DIR,
    format: "esm",
    sourcemap: true,
  },
  plugins: [
    multiInput({ relative: INPUT_DIR }),
    resolve({
      preferBuiltins: false,
      extensions: [".js", ".ts"],
    }),
    commonjs(),
    postcss({ extract: true, sourceMap: true, minimize: true }),
    json(),
    nodePolyfills(),
    babel({
      babelHelpers: "bundled",
      extensions: [".js", ".ts"],
      exclude: "node_modules/**",
    }),
    terser(),
  ],
  watch: {
    chokidar: {
      usePolling: true,
    },
    include: `${INPUT_DIR}/**/*.ts`,
    exclude: `${INPUT_DIR}/**/*.d.ts`,
  },
};
