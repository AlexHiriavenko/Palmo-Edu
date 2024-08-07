import { cartCountElement } from "./elementsDOM.js";

function addToCart() {
  const target = event.target.closest("button");

  if (target) {
    const allCards = JSON.parse(localStorage.getItem("allCards")) || [];
    const shoppingCart = JSON.parse(localStorage.getItem("shoppingCart")) || [];

    let count = +localStorage.getItem("count") || 0;

    const candidateToCart =
      allCards.find((card) => card.articul === +target.id) || null;

    if (isObj(candidateToCart)) {
      const isItemInCart = shoppingCart.find(
        (card) => card?.articul === candidateToCart?.articul
      );

      if (isItemInCart) {
        alert("этот товар уже есть в корзине");
      } else {
        shoppingCart.push(candidateToCart);
        localStorage.setItem("shoppingCart", JSON.stringify(shoppingCart));
        count += 1;
        cartCountElement.textContent = count;
        localStorage.setItem("count", count);
      }
    }
  }
}

function isObj(obj) {
  return (
    typeof obj === "object" &&
    obj !== null &&
    Object.getPrototypeOf(obj) === Object.prototype
  );
}

export default addToCart;
