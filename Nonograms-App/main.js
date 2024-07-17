import {
  setAccentLink,
  themeSwitcher,
  toggleTheme,
} from "./components/header/header";

setAccentLink();

themeSwitcher.addEventListener("click", toggleTheme);
