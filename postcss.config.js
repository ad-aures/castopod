/* eslint-disable */

module.exports = {
  plugins: [
    require("postcss-import"),
    require("postcss-reporter"),
    require("tailwindcss"),
    require("postcss-preset-env")({ stage: 1 }),
    ...(process.env.NODE_ENV === "production"
      ? [
          require("cssnano")({
            preset: "default",
          }),
        ]
      : []),
  ],
};
