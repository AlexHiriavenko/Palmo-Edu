import { cartCountElement } from "./elementsDOM.js";

function clearCart(event) {
  const target = event.target.closest("button");

  if (target) {
    let shoppingCart = [];
    let count = 0;

    localStorage.setItem("shoppingCart", JSON.stringify(shoppingCart));
    localStorage.setItem("count", count);

    cartCountElement.textContent = count;

    const table = document.getElementById("table-body");

    while (table.firstChild) {
      table.firstChild.remove();
    }
  }
}

export default clearCart;
