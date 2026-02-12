import { defineConfig } from "astro/config";
import svelte from "@astrojs/svelte";
import tailwind from "@astrojs/tailwind";
import sitemap from "@astrojs/sitemap";

export default defineConfig({
  site: "https://abdulla.dev", // Update this when you have your domain
  output: "static",
  integrations: [
    svelte(),
    tailwind(),
    sitemap(),
  ],
  markdown: {
    shikiConfig: {
      theme: "github-dark",
    },
  },
});
