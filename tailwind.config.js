/* eslint-disable */

module.exports = {
  mode: "jit",
  purge: [
    "./app/Views/**/*.php",
    "./app/View/Components/**/*.php",
    "./modules/**/Views/**/*.php",
    "./app/Helpers/*.php",
    "./app/Resources/**/*.ts",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Montserrat", "sans-serif"],
        display: ["Kumbh Sans", "sans-serif"],
        body: ["Montserrat", "sans-serif"],
      },
      colors: {
        pine: {
          50: "#ebf8f8",
          100: "#cff7f3",
          200: "#9df2e4",
          300: "#5ee8d4",
          400: "#1cd7ba",
          500: "#08c09a",
          600: "#07a57d",
          700: "#009486",
          800: "#006D60",
          900: "#00564A",
        },
        rose: {
          50: "#fcf9f8",
          100: "#fdeef2",
          200: "#fbcfe4",
          300: "#faa7cd",
          400: "#fb6ea5",
          500: "#fc437c",
          600: "#f24664",
          700: "#dd1f47",
          800: "#b21a39",
          900: "#8e162e",
        },
      },
      spacing: {
        112: "28rem",
      },
      gridTemplateColumns: {
        podcasts: "repeat(auto-fill, minmax(14rem, 1fr))",
      },
    },
  },
  variants: {},
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/line-clamp"),
  ],
};
