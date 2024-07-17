import { setAccentLink, themeSwitcher } from "./components/header/header";
import { getCookie } from "./js-utilits/cookie/getCookie";
import { setTheme } from "./js-utilits/theme/setTheme";
import { toggleTheme } from "./js-utilits/theme/toggleTheme";

document.addEventListener("DOMContentLoaded", function () {
  const currentTheme = getCookie("displayMode") || "light";
  setTheme(currentTheme);
});

themeSwitcher.addEventListener("click", toggleTheme);

setAccentLink();
