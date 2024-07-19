import { setCookie } from "../cookie/setCookie";

export function switchTheme(event) {
  if (event.currentTarget.checked) {
    document.documentElement.classList.replace("light", "dark");
    setCookie("displayMode", "dark", 30);
  } else {
    document.documentElement.classList.replace("dark", "light");
    setCookie("displayMode", "light", 30);
  }
}
