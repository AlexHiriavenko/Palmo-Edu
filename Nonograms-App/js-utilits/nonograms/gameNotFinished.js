import appState from "../../AppState";

const { truthyCellsIndexes, excludedCellsIndexes } = appState.nonogram;

export const gameNotFinished =
  truthyCellsIndexes.length || excludedCellsIndexes.length;
