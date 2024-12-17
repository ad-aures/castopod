/* eslint-disable */

module.exports = {
  plugins: [
    require("postcss-reporter"),
    require("tailwindcss"),
    require("postcss-preset-env")({
      stage: 4,
      features: { "nesting-rules": false },
    }),
    ...(process.env.NODE_ENV === "production"
      ? [
          require("cssnano")({
            preset: "default",
          }),
        ]
      : []),
  ],
};
