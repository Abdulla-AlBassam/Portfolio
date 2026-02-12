import { defineConfig } from "astro/config";
import svelte from "@astrojs/svelte";
import tailwind from "@astrojs/tailwind";

export default defineConfig({
  site: "https://abdulla.dev",
  output: "static",
  integrations: [svelte(), tailwind()],
});
