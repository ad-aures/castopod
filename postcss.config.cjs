/* eslint-disable */

module.exports = {
  plugins: [
    require("postcss-reporter"),
    require("tailwindcss/nesting")(require("postcss-nesting")),
    require("tailwindcss"),
    require("postcss-preset-env")({
      stage: 1,
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
