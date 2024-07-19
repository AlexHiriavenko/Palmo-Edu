import { openModal } from "../modal/js/openModal";
const startGameButton = document.querySelector(".control-btn.new-game");

function initGameInterface() {
  startGameButton.addEventListener("click", openModal);
}

export { initGameInterface };
