export function toggleTheme(event) {
  if (event.currentTarget.checked) {
    document.documentElement.classList.replace("light", "dark");
    localStorage.setItem("darkMode_", "on");
  } else {
    document.documentElement.classList.replace("dark", "light");
    localStorage.setItem("darkMode_", "off");
  }
}
