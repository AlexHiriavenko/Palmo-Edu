import appState from "../../../AppState";
import { initVictory } from "../../../js-utilits/nonograms/initVictory";

export function tableBodyLeftClick(event, cells) {
  if (event.target.nodeName !== "TD") {
    return;
  }

  const progress = appState.nonogram.currentProgress;
  const matrix = appState.nonogram.matrix;

  const clickedCell = event.target;

  clickedCell.classList.toggle("colorized");
  clickedCell.classList.remove("excluded");

  const clickedCellIndex = cells.indexOf(clickedCell);

  // определяем индекс вложенного массива/строки в матрице по которому был клик
  const targetInnerArrIndex = Math.floor(clickedCellIndex / matrix.length);
  // находим индекс ячейки в массиве с индексом targetInnerArrIndex, по которой был клик
  const cellIndex = clickedCellIndex - matrix.length * targetInnerArrIndex;

  const progressTargetArray = progress[targetInnerArrIndex];
  let targetCell = progressTargetArray[cellIndex];

  targetCell = targetCell ? 0 : 1;

  progressTargetArray[cellIndex] = targetCell;

  const truthyIndexes = appState.nonogram.truthyCellsIndexes;
  const excludedIndexes = appState.nonogram.excludedCellsIndexes;

  if (targetCell) {
    truthyIndexes.push(clickedCellIndex);
  } else {
    const canceledIndex = truthyIndexes.indexOf(clickedCellIndex);
    if (canceledIndex !== -1) {
      truthyIndexes.splice(canceledIndex, 1);
    }
  }

  const canceledIndex = excludedIndexes.indexOf(clickedCellIndex);
  if (canceledIndex !== -1) {
    excludedIndexes.splice(canceledIndex, 1);
  }

  const nonogramData =
    JSON.parse(localStorage.getItem("currentNonogram")) || {};
  nonogramData.currentProgress = progress;
  nonogramData.truthyCellsIndexes = truthyIndexes;
  nonogramData.excludedCellsIndexes = excludedIndexes;
  localStorage.setItem("currentNonogram", JSON.stringify(nonogramData));

  const victory = JSON.stringify(progress) === JSON.stringify(matrix);

  if (victory) {
    initVictory();
  }
}
