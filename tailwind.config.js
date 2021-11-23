/* eslint-disable */
const defaultTheme = require("tailwindcss/defaultTheme");

function withOpacity(variableName) {
  return ({ opacityValue }) => {
    if (opacityValue !== undefined) {
      return `hsl(var(${variableName}) / ${opacityValue})`;
    }
    return `hsl(var(${variableName}))`;
  };
}

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
      },
      textColor: {
        skin: {
          base: withOpacity("--color-text-base"),
          muted: withOpacity("--color-text-muted"),
        },
        accent: {
          base: withOpacity("--color-accent-base"),
          hover: withOpacity("--color-accent-hover"),
          muted: withOpacity("--color-accent-muted"),
          contrast: withOpacity("--color-accent-contrast"),
        },
      },
      backgroundColor: {
        base: withOpacity("--color-background-base"),
        elevated: withOpacity("--color-background-elevated"),
        navigation: withOpacity("--color-background-navigation"),
        backdrop: withOpacity("--color-background-backdrop"),
        header: withOpacity("--color-background-header"),
        accent: {
          base: withOpacity("--color-accent-base"),
          hover: withOpacity("--color-accent-hover"),
        },
        highlight: withOpacity("--color-background-highlight"),
      },
      borderColor: {
        subtle: withOpacity("--color-border-subtle"),
        contrast: withOpacity("--color-border-contrast"),
        navigation: withOpacity("--color-border-navigation"),
        "navigation-bg": withOpacity("--color-background-navigation"),
        accent: {
          base: withOpacity("--color-accent-base"),
          hover: withOpacity("--color-accent-hover"),
        },
        background: {
          base: withOpacity("--color-background-base"),
          elevated: withOpacity("--color-background-elevated"),
        },
      },
      ringColor: {
        contrast: withOpacity("--color-border-contrast"),
        background: {
          base: withOpacity("--color-background-base"),
          elevated: withOpacity("--color-background-elevated"),
        },
      },
      colors: {
        background: {
          header: withOpacity("--color-background-header"),
        },
        heading: {
          foreground: withOpacity("--color-heading-foreground"),
          background: withOpacity("--color-heading-background"),
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
    },
  },
  variants: {},
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/line-clamp"),
  ],
};
