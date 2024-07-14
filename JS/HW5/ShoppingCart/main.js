import getData from "./js/getData.js";
import addToCart from "./js/addToCart.js";

export const cartCountElement = document.querySelector(
  ".shopping-cart-btn span"
);
let count = +localStorage.getItem("count") || 0;
cartCountElement.textContent = count;

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

renderCards();

const tableBody = document.getElementById("table-body");
const template = document.getElementById("table-template").content;
const modal = document.getElementById("modal");
const openCartBtn = document.querySelector(".shopping-cart-btn");

openCartBtn.addEventListener("click", openCart);

function openCart() {
  const cart = JSON.parse(localStorage.getItem("shoppingCart")) || [];
  tableBody.innerHTML = "";
  if (!cart.length) {
    alert("пока что Корзина пуста");
  } else {
    cart.forEach((card) => {
      const clone = document.importNode(template, true);
      clone.querySelector(".td-articul").textContent = card.articul;
      clone.querySelector(".td-product").textContent = card.name;
      clone.querySelector(".td-image img").src = card.img;
      clone.querySelector(".td-price").textContent = card.price;
      tableBody.appendChild(clone);
    });

    modal.style.display = "flex";
  }
}

const closeModalBtn = document.querySelector(".close-modal-btn");

closeModalBtn.addEventListener("click", () => (modal.style.display = "none"));
