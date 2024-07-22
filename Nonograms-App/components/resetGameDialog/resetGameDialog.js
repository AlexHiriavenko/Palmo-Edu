import { closeModal } from "../modal/functions/closeModal";

export function createResetGameDialog() {
  const template = document.getElementById("resetGameDialog");
  const resetGameDialog = template.content.cloneNode(true);

  const btnOK = resetGameDialog.querySelector(".ok");
  btnOK.addEventListener("click", closeModal);

  return resetGameDialog;
}
