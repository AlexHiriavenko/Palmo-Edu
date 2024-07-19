import { setAccentLink, themeSwitcher } from "./components/header/header";
import { getCookie } from "./js-utilits/cookie/getCookie";
import { setTheme } from "./js-utilits/theme/setTheme";
import { switchTheme } from "./js-utilits/theme/switchTheme";
import { musicSwitcher, switchMusic } from "./js-utilits/music/switchMusic";
import { initGameInterface } from "./components/gameButtons/gameButtons";

// при загрузке страницы установить тему (светлая / темная)
document.addEventListener("DOMContentLoaded", function () {
  const currentTheme = getCookie("displayMode") || "light";
  setTheme(currentTheme);
});

// инициализация интерфейса переключения режима светлой/темной темы
themeSwitcher.addEventListener("click", switchTheme);

// установить акцент на ссылку, которая соответствует текущей странице.
setAccentLink();

// инициализация интерфейса включения/отключения музыки
musicSwitcher.addEventListener("click", switchMusic);

// инициализация интерфейса игры
initGameInterface();
