import { cartCountElement } from "./elementsDOM.js";

function setCartCount() {
  let count = +localStorage.getItem("count") || 0;
  cartCountElement.textContent = count;
}

export default setCartCount;
