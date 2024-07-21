import { modalContainer, modal } from "../modal";

function closeModal() {
  modalContainer.classList.remove("active");
  modal.classList.remove("active");

  while (modal.firstElementChild.nextElementSibling) {
    modal.firstElementChild.nextElementSibling.remove();
  }
}

const closeModalButton = modal?.querySelector(".close");

export { closeModalButton, closeModal };
