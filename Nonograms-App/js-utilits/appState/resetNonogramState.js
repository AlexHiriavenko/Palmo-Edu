import { setNonogramState } from "./setNonogramState";

export function resetNonogramState() {
  const nonogramData = {
    name: "",
    playerName: "",
    difficulty: "",
    matrix: [],
    currentProgress: [],
    truthyCells: [],
    falsyCells: [],
    truthyCellsIndexes: [],
    excludedCellsIndexes: [],
  };

  setNonogramState(nonogramData);
  localStorage.setItem("currentNonogram", JSON.stringify(nonogramData));
}
