import globals from "globals";
import eslint from "@eslint/js";
import tseslint from "typescript-eslint";
import eslintPluginPrettierRecommended from "eslint-plugin-prettier/recommended";

export default [
  ...tseslint.config(
    eslint.configs.recommended,
    ...tseslint.configs.strict,
    eslintPluginPrettierRecommended
  ),
  {
    ignores: ["public/*", "docs/*", "vendor/*", "castopod/*"],
  },
  {
    languageOptions: {
      globals: {
        ...globals.browser,
        ...globals.node,
      },
    },
  },
];
