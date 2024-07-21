import { openModal } from "../modal/functions/openModal";
import { appendModalContent } from "../modal/functions/appendModalContent";
import { createNewGameDialog } from "../newGameDialog/newGameDialog";

const startGameButton = document.querySelector(".control-btn.new-game");

function initializeGameControls() {
  startGameButton?.addEventListener("click", () => {
    const newGameDialog = createNewGameDialog();
    appendModalContent(newGameDialog);
    openModal("confirm");
  });
}

export { initializeGameControls };
