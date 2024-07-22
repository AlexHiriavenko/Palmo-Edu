import { openModal } from "../modal/functions/openModal";
import { appendModalContent } from "../modal/functions/appendModalContent";
import { createNewGameDialog } from "../newGameDialog/newGameDialog";
import { gameResetRequest } from "../resetGameDialog/functions/gameResetRequest";
import { showSolutionRequest } from "../showSolutionDialog/functions/showSolutionRequest";

const startGameButton = document.querySelector(".control-btn.new-game");
const resetGameButton = document.querySelector(".control-btn.reset-game");
const showSolutionButton = document.querySelector(".control-btn.show-solution");

function initializeGameControls() {
  startGameButton?.addEventListener("click", () => {
    const newGameDialog = createNewGameDialog();
    appendModalContent(newGameDialog);
    openModal("confirm");
  });

  resetGameButton?.addEventListener("click", gameResetRequest);

  showSolutionButton?.addEventListener("click", showSolutionRequest);
}

export { initializeGameControls };
