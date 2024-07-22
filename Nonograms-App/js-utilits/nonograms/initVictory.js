import { showSolution } from "../../components/showSolutionDialog/functions/showSolution";
import { openModal } from "../../components/modal/functions/openModal";
import { createVictoryDialog } from "../../components/victoryDialog/victoryDialog";
import { appendModalContent } from "../../components/modal/functions/appendModalContent";
import appState from "../../AppState";

export function initVictory() {
  const victoryData = JSON.parse(JSON.stringify(appState.nonogram));
  const victoryDialog = createVictoryDialog();
  appendModalContent(victoryDialog);
  openModal("victory");
  showSolution();
}
