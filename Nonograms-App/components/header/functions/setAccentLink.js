export function setAccentLink() {
  const path = window.location.pathname;

  const nonogramsLink = document.querySelector(".header__link.nonograms");
  const galleryLink = document.querySelector(".header__link.gallery");

  const accentLink = path.endsWith("/nonograms/") ? nonogramsLink : galleryLink;

  accentLink.classList.add("accent");
}
