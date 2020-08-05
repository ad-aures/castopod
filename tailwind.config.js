/* eslint-disable */

module.exports = {
  purge: ["./app/Views/**/*.php", "./app/Views/**/*.ts"],
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [
    require("@tailwindcss/custom-forms"),
    require("@tailwindcss/typography"),
  ],
};
