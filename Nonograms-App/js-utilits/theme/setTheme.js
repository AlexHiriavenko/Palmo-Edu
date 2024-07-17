export function setTheme(value) {
  const themeSwitcher = document.querySelector(".switch-theme__input");
  themeSwitcher.checked = value === "dark";

  document.documentElement.className = value;
}
