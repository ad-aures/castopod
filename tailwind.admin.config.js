import defaultTheme from "tailwindcss/defaultTheme";
import tailwindForms from "@tailwindcss/forms";
import tailwindTypography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./app/Views/**/*.php",
    "./themes/cp_admin/**/*.php",
    "./themes/cp_auth/**/*.php",
    "./app/Helpers/*.php",
    "./resources/**/*.ts",
  ],
  theme: {
    extend: {
      content: {
        chevronRightIcon:
          "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 24 24'%3E%3Cpath d='M13.17 12 8.22 7.05l1.42-1.41L16 12l-6.36 6.36-1.42-1.41L13.17 12Z'/%3E%3C/svg%3E%0A\")",
        prohibitedIcon:
          "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 24 24'%3E%3Cpath d='M7.0943 5.68009L18.3199 16.9057C19.3736 15.5506 20 13.8491 20 12C20 7.58172 16.4183 4 12 4C10.1509 4 8.44939 4.62644 7.0943 5.68009ZM16.9057 18.3199L5.68009 7.0943C4.62644 8.44939 4 10.1509 4 12C4 16.4183 7.58172 20 12 20C13.8491 20 15.5506 19.3736 16.9057 18.3199ZM4.92893 4.92893C6.73748 3.12038 9.23885 2 12 2C17.5228 2 22 6.47715 22 12C22 14.7611 20.8796 17.2625 19.0711 19.0711C17.2625 20.8796 14.7611 22 12 22C6.47715 22 2 17.5228 2 12C2 9.23885 3.12038 6.73748 4.92893 4.92893Z'/%3E%3C/svg%3E%0A\")",
      },
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
      gridTemplateColumns: {
        admin: "300px calc(100% - 300px)",
        podcast: "1fr minmax(auto, 960px) 1fr",
        podcastMain: "1fr minmax(200px, 300px)",
        cards: "repeat(auto-fill, minmax(14rem, 1fr))",
        latestEpisodes: "repeat(5, 1fr)",
        colorButtons: "repeat(auto-fill, minmax(4rem, 1fr))",
        platforms: "repeat(auto-fill, minmax(18rem, 1fr))",
        plugins: "repeat(auto-fill, minmax(20rem, 1fr))",
        radioGroup: "repeat(auto-fit, minmax(14rem, 1fr))",
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
            input: {
              margin: 0,
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
      keyframes: {
        "slight-pulse": {
          "0%": { transform: "scale(1)" },
          "60%": { transform: "scale(0.96)" },
          "75%": { transform: "scale(1.05)" },
          "95%": { transform: "scale(0.98)" },
          "100%": { transform: "scale(1)" },
        },
      },
      animation: {
        "single-pulse": "slight-pulse 300ms linear 1",
      },
    },
  },
  variants: {},
  plugins: [tailwindForms, tailwindTypography],
};
