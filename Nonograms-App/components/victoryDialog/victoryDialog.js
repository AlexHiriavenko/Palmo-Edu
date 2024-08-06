import { closeModal } from "../modal/functions/closeModal";

export function createVictoryDialog() {
  const template = document.getElementById("victoryDialog");
  const victoryDialog = template.content.cloneNode(true);

  const btnOK = victoryDialog.querySelector(".ok");

  btnOK.addEventListener("click", closeModal);

  return victoryDialog;
}
