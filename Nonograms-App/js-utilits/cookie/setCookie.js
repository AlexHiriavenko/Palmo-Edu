export function setCookie(name, value, days) {
  let date = new Date();
  date.setTime(date.getTime() + getMilliseconds(days));
  let expires = `expires=${date.toUTCString()}`;
  document.cookie = `${name}=${value};${expires};path=/`;
}

function getMilliseconds(days) {
  return days * 24 * 60 * 60 * 1000;
}
