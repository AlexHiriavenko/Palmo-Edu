import { unsplash } from "../../api/UnsplashAPI";
import { renderImages } from "./renderImages";

async function renderRandomImages() {
  const randomImages = await unsplash.getRandomPhotos(30);
  renderImages(randomImages);
}

export { renderRandomImages };
