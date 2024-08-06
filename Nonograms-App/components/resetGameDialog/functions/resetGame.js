import appState from "../../../AppState";
import { arrFillZeros } from "../../../js-utilits/nonograms/arrayFillZeros";
import { setNonogramState } from "../../../js-utilits/appState/setNonogramState";
import { table } from "../../nonogramTable/nonogramTable";
import { createTableBody } from "../../nonogramTable/functions/createTableBody";

export function resetGame() {
  const tbody = table.querySelector("tbody");
  const thead = table.querySelector("thead");
  tbody.remove();

  const matrixLength = appState.nonogram.matrix.length;

  const resetProps = {
    currentProgress: arrFillZeros(matrixLength),
    excludedCellsIndexes: [],
    truthyCellsIndexes: [],
  };

  setNonogramState(resetProps);
  // appState.nonogram.currentProgress = arrFillZeros(matrixLength);
  // appState.nonogram.excludedCellsIndexes = [];
  // appState.nonogram.truthyCellsIndexes = [];

  const nonogramData =
    JSON.parse(localStorage.getItem("currentNonogram")) || {};
  nonogramData.currentProgress = appState.nonogram.currentProgress;
  nonogramData.excludedCellsIndexes = appState.nonogram.excludedCellsIndexes;
  nonogramData.truthyCellsIndexes = appState.nonogram.truthyCellsIndexes;

  localStorage.setItem("currentNonogram", JSON.stringify(nonogramData));

  thead.insertAdjacentElement("afterend", createTableBody());
}
