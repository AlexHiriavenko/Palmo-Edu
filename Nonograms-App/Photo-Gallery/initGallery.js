import { unsplash } from "./api/UnsplashAPI";
import { renderImages } from "./components/images-gallery/renderImages";
import { selects } from "./components/search-menu/search-menu";

function resetSelects(exceptSelect) {
  selects.forEach((select) => {
    if (select !== exceptSelect) {
      select.selectedIndex = 0;
    }
  });
}

function initGallery() {
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

export default initGallery;
