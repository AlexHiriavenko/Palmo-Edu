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
import { gameNotFinished } from "./js-utilits/nonograms/gameNotFinished";
import { timer } from "./js-utilits/timer/timerInstance";
import { continueGame } from "./js-utilits/nonograms/continueGame";
import { renderRandomImages } from "./Photo-Gallery/components/images-gallery/renderRandomImages";
import initGallery from "./Photo-Gallery/initGallery";

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

const path = window.location.pathname;
const isMainPage = path.endsWith("/nonograms/");
const isGalleryPage = path.endsWith("/Photo-Gallery/");

if (isMainPage) {
  // инициализация интерфейса игровых кнопок (слушатели на кнопки)
  initializeGameControls();

  // интерфейс закрытия модального окна
  closeModalButton?.addEventListener("click", closeModal);

  //
  if (gameNotFinished) {
    continueGame();
  } else {
    timer.reset();
  }
}

if (isGalleryPage) {
  renderRandomImages();
  initGallery();
}
