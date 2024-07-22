import { closeModal } from "../modal/functions/closeModal";
import { showSolution } from "./functions/showSolution";

export function createShowSloutionDialog() {
  const template = document.getElementById("showSolutionDialog");
  const showSolutionDialog = template.content.cloneNode(true);

  const btnSubmit = showSolutionDialog.querySelector(".submit");
  const btnCancel = showSolutionDialog.querySelector(".cancel");

  btnSubmit.addEventListener("click", () => {
    showSolution();
    closeModal();
  });
  btnCancel.addEventListener("click", closeModal);

  return showSolutionDialog;
}
