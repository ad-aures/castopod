import defaultTheme from "tailwindcss/defaultTheme";
import tailwindForms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./app/Views/**/*.php",
    "./themes/cp_install/**/*.php",
    "./resources/**/*.ts",
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
        subtle: "hsl(var(--color-border-subtle) / <alpha-value>)",
        navigation: "hsl(var(--color-background-navigation) / <alpha-value>)",
        "navigation-active":
          "hsl(var(--color-background-navigation-active) / <alpha-value>)",
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
        accent: {
          base: "hsl(var(--color-accent-base) / <alpha-value>)",
          hover: "hsl(var(--color-accent-hover) / <alpha-value>)",
        },
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
  plugins: [tailwindForms],
};
