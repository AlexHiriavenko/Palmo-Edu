import { unsplash } from "../../api/UnsplashAPI";
import { renderImages } from "../images-gallery/renderImages";

export const selects = document.querySelectorAll(".gallery-form select");

function initSearchMenu() {
  selects.forEach((select) => {
    select.addEventListener("change", async (event) => {
      try {
        resetSelects(event.target);
        const images = await unsplash.searchPhotos(event.target.value);
        renderImages(images);
      } catch (error) {
        console.error("Ошибка при получении изображений:", error);
      }
    });
  });
}

function resetSelects(exceptSelect) {
  selects.forEach((select) => {
    if (select !== exceptSelect) {
      select.selectedIndex = 0;
    }
  });
}

export default initSearchMenu;
