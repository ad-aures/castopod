/* eslint-disable */

module.exports = {
  mode: "jit",
  purge: [
    "./app/Views/**/*.php",
    "./modules/**/Views/**/*.php",
    "./themes/**/*.php",
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
          50: "#F2FAF9",
          100: "#E7F9E4",
          200: "#bfe4e1",
          300: "#99d4cf",
          400: "#4db4aa",
          500: "#009486",
          600: "#008579",
          700: "#006D60",
          800: "#00564A",
          900: "#003D0B",
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
      zIndex: {
        "-10": "-10",
      },
      borderWidth: {
        3: "3px",
      },
      ringWidth: {
        3: "3px",
      },
    },
  },
  variants: {},
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/line-clamp"),
    require("tailwindcss-scroll-snap"),
  ],
};
