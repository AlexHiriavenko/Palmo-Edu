import { closeModal } from "../modal/functions/closeModal";

export function createHowToPlayDialog() {
  const template = document.getElementById("helpDialog");
  const howToPlayDialog = template.content.cloneNode(true);

  const btnOK = howToPlayDialog.querySelector(".ok");

  btnOK.addEventListener("click", closeModal);

  return howToPlayDialog;
}
