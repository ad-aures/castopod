/* eslint-disable */

module.exports = {
  purge: ["./app/Views/**/*.php", "./app/Views/**/*.ts", "./app/Helpers/*.php"],
  theme: {},
  variants: {
    textDecoration: ["responsive", "hover", "focus", "group-hover"],
  },
  plugins: [
    require("@tailwindcss/custom-forms"),
    require("@tailwindcss/typography"),
  ],
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
    defaultLineHeights: true,
    standardFontWeights: true,
  },
};
