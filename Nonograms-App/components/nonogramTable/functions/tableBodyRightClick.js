import appState from "../../../AppState";
import { initVictory } from "../../../js-utilits/nonograms/initVictory";

export function tableBodyRightClick(event, cells) {
  if (event.target.nodeName !== "TD") {
    return;
  }

  event.preventDefault();
  const progress = appState.nonogram.currentProgress;
  const matrix = appState.nonogram.matrix;

  const clickedCell = event.target;
  const clickedCellIndex = cells.indexOf(clickedCell);

  // определяем индекс вложенного массива/строки в матрице по которому был клик
  const targetInnerArrIndex = Math.floor(clickedCellIndex / matrix.length);
  // находим индекс ячейки в массиве с индексом targetInnerArrIndex, по которой был клик
  const cellIndex = clickedCellIndex - matrix.length * targetInnerArrIndex;

  const progressTargetArray = progress[targetInnerArrIndex];

  progressTargetArray[cellIndex] = 0;
  clickedCell.classList.remove("colorized");

  const excludedIndexes = appState.nonogram.excludedCellsIndexes;
  const truthyIndexes = appState.nonogram.truthyCellsIndexes;

  if (clickedCell.classList.contains("excluded")) {
    clickedCell.classList.remove("excluded");
    const canceledIndex = excludedIndexes.indexOf(clickedCellIndex);
    if (canceledIndex !== -1) {
      excludedIndexes.splice(canceledIndex, 1);
    }
  } else {
    clickedCell.classList.add("excluded");
    excludedIndexes.push(clickedCellIndex);
  }

  // Удаляем индекс из truthyIndexes, если он существует
  const canceledIndex = truthyIndexes.indexOf(clickedCellIndex);
  if (canceledIndex !== -1) {
    truthyIndexes.splice(canceledIndex, 1);
  }

  const nonogramData =
    JSON.parse(localStorage.getItem("currentNonogram")) || {};
  nonogramData.currentProgress = progress;
  nonogramData.excludedCellsIndexes = excludedIndexes;
  nonogramData.truthyCellsIndexes = truthyIndexes;
  localStorage.setItem("currentNonogram", JSON.stringify(nonogramData));

  const victory = JSON.stringify(progress) === JSON.stringify(matrix);

  if (victory) {
    initVictory();
  }
}
