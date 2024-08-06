import { renderNonogramTable } from "../../components/nonogramTable/nonogramTable";
import { table } from "../../components/nonogramTable/nonogramTable";
import appState from "../../AppState";

export function continueGame() {
  renderNonogramTable();

  const cells = table.querySelectorAll("td");

  const { truthyCellsIndexes, excludedCellsIndexes } = appState.nonogram;

  cells.forEach((cell, i) => {
    if (truthyCellsIndexes.includes(i)) {
      cell.classList.add("colorized");
    }
    if (excludedCellsIndexes.includes(i)) {
      cell.classList.add("excluded");
    }
  });
}
