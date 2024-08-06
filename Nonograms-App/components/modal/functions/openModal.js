import { modalContainer, modal } from "../modal";

export function openModal(specialClassName) {
  if (specialClassName) {
    modal.classList.add(specialClassName);
  }
  modalContainer.classList.add("active");
  modal.classList.add("active");
}
