import renderCards from "./js/renderCards.js";
import openCart from "./js/openCart.js";
import closeCart from "./js/closeCart.js";
import setCartCount from "./js/setCartCount.js";
import { openCartBtn, closeCartBtn, clearCartBtn } from "./js/elementsDOM.js";
import clearCart from "./js/clearCart.js";

setCartCount();
renderCards();

openCartBtn.addEventListener("click", openCart);
closeCartBtn.addEventListener("click", closeCart);
clearCartBtn.addEventListener("click", clearCart);
