/* eslint-disable */

module.exports = {
  purge: ["./app/Views/**/*.php", "./app/Views/**/*.ts"],
  theme: {
    extend: {},
  },
  variants: {
    textDecoration: ["responsive", "hover", "focus", "group-hover"],
  },
  plugins: [
    require("@tailwindcss/custom-forms"),
    require("@tailwindcss/typography"),
  ],
};
