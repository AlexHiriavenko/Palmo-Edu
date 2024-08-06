export function getCookie(name) {
  const cookies = document.cookie.split(";").map((cookie) => cookie.trim());

  for (const cookie of cookies) {
    const [cookieKey, cookieValue] = cookie.split("=");
    if (cookieKey === name) {
      return cookieValue;
    }
  }

  return null;
}
