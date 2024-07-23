import appState from "../../../AppState";
import { resetNonogramState } from "../../../js-utilits/appState/resetNonogramState";
import { timer } from "../../../js-utilits/timer/timerInstance";
import { table } from "../../nonogramTable/nonogramTable";

export function showSolution() {
  const { truthyCells, falsyCells } = appState.nonogram;

  truthyCells.forEach((cell) => {
    cell.classList.remove("excluded", "border5x5H", "border5x5V");
    cell.classList.add("colorized");
  });
  falsyCells.forEach((cell) => {
    cell.classList.remove("colorized", "excluded", "border5x5H", "border5x5V");
  });

  table.style.pointerEvents = "none";
  resetNonogramState();
  timer.reset();
}
