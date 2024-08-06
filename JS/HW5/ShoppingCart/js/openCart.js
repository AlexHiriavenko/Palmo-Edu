import { modal } from "./elementsDOM.js";

const tableBody = document.getElementById("table-body");
const template = document.getElementById("table-template").content;

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

export default openCart;
