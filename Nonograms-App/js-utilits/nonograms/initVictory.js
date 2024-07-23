import appState from "../../AppState";
import { timer } from "../timer/timerInstance";
import { createVictoryDialog } from "../../components/victoryDialog/victoryDialog";
import { appendModalContent } from "../../components/modal/functions/appendModalContent";
import { openModal } from "../../components/modal/functions/openModal";
import { writeRecord } from "./writeRecord";
import { showSolution } from "../../components/showSolutionDialog/functions/showSolution";

export function initVictory() {
  const nonogramData = JSON.parse(JSON.stringify(appState.nonogram));
  const { name: nonogramName, playerName, difficulty } = nonogramData;
  const time = timer.getTime();
  const gameResults = {
    nonogramName,
    playerName,
    difficulty,
    time,
  };
  const victoryDialog = createVictoryDialog();
  appendModalContent(victoryDialog);
  openModal("victory");
  writeRecord(gameResults);
  showSolution();
}
