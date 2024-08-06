import { openModal } from "../modal/functions/openModal";
import { appendModalContent } from "../modal/functions/appendModalContent";
import { createNewGameDialog } from "../newGameDialog/newGameDialog";
import { gameResetRequest } from "../resetGameDialog/functions/gameResetRequest";
import { showSolutionRequest } from "../showSolutionDialog/functions/showSolutionRequest";
import { createRecordsTable } from "../gameRecordsTable/createRecordsTable";

const startGameButton = document.querySelector(".control-btn.new-game");
const resetGameButton = document.querySelector(".control-btn.reset-game");
const showSolutionButton = document.querySelector(".control-btn.show-solution");
const recordsButton = document.querySelector(".control-btn.records");

function initializeGameControls() {
  startGameButton?.addEventListener("click", () => {
    const newGameDialog = createNewGameDialog();
    appendModalContent(newGameDialog);
    openModal("confirm");
  });

  resetGameButton?.addEventListener("click", gameResetRequest);

  showSolutionButton?.addEventListener("click", showSolutionRequest);

  recordsButton?.addEventListener("click", () => {
    const recordsTable = createRecordsTable();
    appendModalContent(recordsTable);
    openModal("records");
  });
}

export { initializeGameControls };
