import getData from "./getData.js";
import addToCart from "./addToCartd.js";

const cardsPath = "./catalog.json";

const cardsSection = document.querySelector(".cards");
const cardTemplate = document.getElementById("card-template");

async function renderCards() {
  const cards = await getData(cardsPath);
  localStorage.setItem("allCards", JSON.stringify(cards));

  cards.forEach((card) => {
    const cardClone = cardTemplate.content.cloneNode(true);

    const cardTitle = cardClone.querySelector(".card__title");
    const cardPrice = cardClone.querySelector(".card__text.price");
    const cardArticul = cardClone.querySelector(".card__text.articul");
    const cardImg = cardClone.querySelector(".card__img");
    const cardBtn = cardClone.querySelector(".card__btn");

    cardTitle.textContent = card?.name || "uknown";
    cardPrice.textContent += card?.price || "uknown";
    cardArticul.textContent += card?.articul || "uknown";
    cardImg.src = card?.img;
    cardBtn.id = card.articul;

    cardBtn.addEventListener("click", (event) => addToCart(event));

    cardsSection.appendChild(cardClone);
  });
}

export default renderCards;
