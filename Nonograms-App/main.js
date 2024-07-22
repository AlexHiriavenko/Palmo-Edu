import { setAccentLink, themeSwitcher } from "./components/header/header";
import { getCookie } from "./js-utilits/cookie/getCookie";
import { setTheme } from "./js-utilits/theme/setTheme";
import { switchTheme } from "./js-utilits/theme/switchTheme";
import { musicSwitcher, switchMusic } from "./js-utilits/music/switchMusic";
import { initializeGameControls } from "./components/gameButtons/gameButtons";
import {
  closeModalButton,
  closeModal,
} from "./components/modal/functions/closeModal";
import appState from "./AppState";

// при загрузке страницы установить тему (светлая / темная)
document.addEventListener("DOMContentLoaded", function () {
  const currentTheme = getCookie("displayMode") || "light";
  setTheme(currentTheme);
});

// инициализация интерфейса переключения режима светлой/темной темы
themeSwitcher.addEventListener("click", switchTheme);

// инициализация интерфейса включения/отключения музыки
musicSwitcher.addEventListener("click", switchMusic);

// установить акцент на ссылку, которая соответствует текущей странице.
setAccentLink();

// инициализация интерфейса игровых кнопок (слушатели на кнопки)
initializeGameControls();

// интерфейс закрытия модального окна
closeModalButton?.addEventListener("click", closeModal);
