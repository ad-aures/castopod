module.exports = {
  plugins: [
    require("autoprefixer"),
    require("cssnano"),
    require("postcss-preset-env")({
      stage: 3,
      features: { "nesting-rules": false },
    }),
  ],
};
