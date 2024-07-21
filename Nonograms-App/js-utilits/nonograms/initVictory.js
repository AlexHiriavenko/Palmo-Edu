import { showSolution } from "../../components/showSolutionDialog/functions/showSolution";
import { openModal } from "../../components/modal/functions/openModal";
import { createVictoryDialog } from "../../components/victoryDialog/victoryDialog";
import { appendModalContent } from "../../components/modal/functions/appendModalContent";

export function initVictory() {
  const victoryDialog = createVictoryDialog();
  appendModalContent(victoryDialog);
  openModal("victory");
  showSolution();
}
