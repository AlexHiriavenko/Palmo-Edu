import { modalContainer, modal } from "./modalDomElements";

export function openModal() {
  modalContainer.classList.add("active");
  modal.classList.add("active");
}
