import { defineConfig } from "vite";
import injectHTML from "vite-plugin-html-inject";
import { resolve } from "path";

export default defineConfig({
  base: "/Palmo-Edu/nonograms/",
  plugins: [
    injectHTML({
      debug: {
        logPath: true,
      },
    }),
  ],
  build: {
    sourcemap: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, "index.html"),
        menu: resolve(__dirname, "Photo-Gallery/index.html"),
      },
    },
  },
});
