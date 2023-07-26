/* eslint-disable */
const defaultTheme = require("tailwindcss/defaultTheme");
const { nodeModuleNameResolver } = require("typescript");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./modules/**/Views/**/*.php",
    "./themes/**/*.php",
    "./app/Helpers/*.php",
    "./app/Resources/**/*.ts",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Inter", ...defaultTheme.fontFamily.sans],
        display: ["Kumbh Sans", ...defaultTheme.fontFamily.sans],
        mono: ["Noto Sans Mono", ...defaultTheme.fontFamily.mono],
      },
      textDecorationThickness: {
        3: "3px",
      },
      textColor: {
        skin: {
          base: "hsl(var(--color-text-base) / <alpha-value>)",
          muted: "hsl(var(--color-text-muted) / <alpha-value>)",
        },
        accent: {
          base: "hsl(var(--color-accent-base) / <alpha-value>)",
          hover: "hsl(var(--color-accent-hover) / <alpha-value>)",
          muted: "hsl(var(--color-accent-muted) / <alpha-value>)",
          contrast: "hsl(var(--color-accent-contrast) / <alpha-value>)",
        },
      },
      backgroundColor: {
        base: "hsl(var(--color-background-base) / <alpha-value>)",
        elevated: "hsl(var(--color-background-elevated) / <alpha-value>)",
        navigation: "hsl(var(--color-background-navigation) / <alpha-value>)",
        backdrop: "hsl(var(--color-background-backdrop) / <alpha-value>)",
        header: "hsl(var(--color-background-header) / <alpha-value>)",
        accent: {
          base: "hsl(var(--color-accent-base) / <alpha-value>)",
          hover: "hsl(var(--color-accent-hover) / <alpha-value>)",
        },
        highlight: "hsl(var(--color-background-highlight) / <alpha-value>)",
      },
      borderColor: {
        subtle: "hsl(var(--color-border-subtle) / <alpha-value>)",
        contrast: "hsl(var(--color-border-contrast) / <alpha-value>)",
        navigation: "hsl(var(--color-border-navigation) / <alpha-value>)",
        "navigation-bg":
          "hsl(var(--color-background-navigation) / <alpha-value>)",
        accent: {
          base: "hsl(var(--color-accent-base) / <alpha-value>)",
          hover: "hsl(var(--color-accent-hover) / <alpha-value>)",
        },
        background: {
          base: "hsl(var(--color-background-base) / <alpha-value>)",
          elevated: "hsl(var(--color-background-elevated) / <alpha-value>)",
        },
      },
      ringColor: {
        contrast: "hsl(var(--color-border-contrast) / <alpha-value>)",
        background: {
          base: "hsl(var(--color-background-base) / <alpha-value>)",
          elevated: "hsl(var(--color-background-elevated) / <alpha-value>)",
        },
      },
      colors: {
        accent: "hsl(var(--color-accent-base) / <alpha-value>)",
        background: {
          header: "hsl(var(--color-background-header) / <alpha-value>)",
          base: "hsl(var(--color-background-base) / <alpha-value>)",
        },
        heading: {
          foreground: "hsl(var(--color-heading-foreground) / <alpha-value>)",
          background: "hsl(var(--color-heading-background) / <alpha-value>)",
        },
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
      gridTemplateColumns: {
        admin: "300px calc(100% - 300px)",
        podcast: "1fr minmax(auto, 960px) 1fr",
        podcastMain: "1fr minmax(200px, 300px)",
        cards: "repeat(auto-fill, minmax(14rem, 1fr))",
        latestEpisodes: "repeat(5, 1fr)",
        colorButtons: "repeat(auto-fill, minmax(4rem, 1fr))",
      },
      gridTemplateRows: {
        admin: "40px 1fr",
      },
      borderWidth: {
        3: "3px",
      },
      ringWidth: {
        3: "3px",
      },
      typography: {
        DEFAULT: {
          css: {
            a: {
              textDecoration: "underline",
              fontWeight: 600,
              "&:hover": {
                textDecoration: "none",
              },
            },
          },
        },
        sm: {
          css: {
            a: {
              textDecoration: "underline",
              fontWeight: 600,
              "&:hover": {
                textDecoration: "none",
              },
            },
          },
        },
      },
      zIndex: {
        60: 60,
      },
    },
  },
  variants: {},
  plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
};
