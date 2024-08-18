const { defineConfig } = require("@vue/cli-service");
const webpack = require("webpack");

module.exports = defineConfig({
  transpileDependencies: true,
  pages: {
    index: {
      entry: "src/main.js", // Путь к основному скрипту страницы index
      title: "Vue HW-2", // Устанавливаем желаемый заголовок
    },
  },
  // верный путь (basic url) для деплоя на gh-pages
  publicPath:
    process.env.NODE_ENV === "production" ? "/Palmo-Edu/VueHW-2/" : "/",
  configureWebpack: {
    experiments: {
      topLevelAwait: true,
    },
    plugins: [
      new webpack.DefinePlugin({
        // управляет включением или отключением Options API в Vue 3.
        // false: Отключает Options API. Это уменьшает размер бандла и насильно заставляет использовать только Composition API.
        __VUE_OPTIONS_API__: JSON.stringify(true),
        // управляет включением или отключением Vue Devtools в продакшене.
        __VUE_PROD_DEVTOOLS__: JSON.stringify(false),
        // управляет включением или отключением подробных сообщений о несоответствии гидратации в продакшене.
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: JSON.stringify(true),
      }),
    ],
  },
});
