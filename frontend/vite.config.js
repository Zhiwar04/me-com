import { fileURLToPath, URL } from "node:url";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import tailwindConfig from "./tailwind.config";

// https://vitejs.dev/configg
export default defineConfig({
  plugins: [vue(), tailwindConfig],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url)),
      jquery: "jquery/dist/jquery.js",
    },
  },
});
