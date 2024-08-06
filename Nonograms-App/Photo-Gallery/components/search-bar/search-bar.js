import { unsplash } from "../../api/UnsplashAPI";
import { renderImages } from "../images-gallery/renderImages";

function initSearchBar() {
  const form = document.querySelector(".searchInputWrapper");
  const input = document.querySelector(".searchInput");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    const query = input.value.trim();

    if (query) {
      try {
        const images = await unsplash.searchPhotos(query);
        renderImages(images);
      } catch (error) {
        console.error("Ошибка при получении изображений:", error);
      }
      input.blur();
    }
  });
}

export default initSearchBar;
