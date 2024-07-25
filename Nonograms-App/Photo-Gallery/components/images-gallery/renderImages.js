const gallery = document.getElementById("grid");

function renderImages(data) {
  if (!data.length) {
    gallery.innerHTML = "По данному запросу картинок не найдено";
  } else {
    gallery.innerHTML = "";

    data.forEach((img) => {
      const path = img.urls.small;
      const description = img.alt_description;

      const image = document.createElement("img");
      image.src = path;
      image.alt = description;

      gallery.append(image);
    });
  }
}

export { renderImages, gallery };
