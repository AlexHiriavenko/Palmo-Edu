import appState from "../../../AppState";
import { resetGame } from "./resetGame";
import { createResetGameDialog } from "../resetGameDialog";
import { openModal } from "../../modal/functions/openModal";
import { appendModalContent } from "../../modal/functions/appendModalContent";

export function gameResetRequest() {
  const isGameExist =
    !!appState?.nonogram?.name && !!appState?.nonogram?.difficulty;

  if (isGameExist) {
    resetGame();
  } else {
    const popAlert = createResetGameDialog();
    appendModalContent(popAlert);
    openModal("alert");
  }
}
