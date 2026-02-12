/** @type {import('tailwindcss').Config} */
export default {
  content: ["./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}"],
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        // Midnight Terminal palette
        bg: {
          DEFAULT: "#0A0A0A",
          surface: "#141414",
          elevated: "#1A1A1A",
        },
        border: {
          DEFAULT: "#262626",
          hover: "#333333",
        },
        text: {
          primary: "#FAFAFA",
          secondary: "#A1A1AA",
          muted: "#71717A",
        },
        accent: {
          DEFAULT: "#22D3EE",
          hover: "#06B6D4",
          muted: "rgba(34, 211, 238, 0.1)",
        },
        // Light mode overrides
        light: {
          bg: "#FAFAFA",
          surface: "#FFFFFF",
          elevated: "#F4F4F5",
          border: "#E4E4E7",
          text: "#09090B",
          "text-secondary": "#52525B",
        },
      },
      fontFamily: {
        sans: [
          "Inter",
          "system-ui",
          "-apple-system",
          "BlinkMacSystemFont",
          "sans-serif",
        ],
        mono: ["JetBrains Mono", "Fira Code", "monospace"],
      },
      animation: {
        "fade-in": "fadeIn 0.6s ease-out forwards",
        "slide-up": "slideUp 0.6s ease-out forwards",
        "glow-pulse": "glowPulse 3s ease-in-out infinite",
      },
      keyframes: {
        fadeIn: {
          "0%": { opacity: "0" },
          "100%": { opacity: "1" },
        },
        slideUp: {
          "0%": { opacity: "0", transform: "translateY(20px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
        glowPulse: {
          "0%, 100%": { opacity: "0.4" },
          "50%": { opacity: "0.8" },
        },
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
