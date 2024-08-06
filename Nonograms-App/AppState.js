const currentNonogram =
  JSON.parse(localStorage.getItem("currentNonogram")) || null;

const defaultPlayerName = "uknown player";

const appState = {
  nonogram: {
    name: currentNonogram?.name || "",
    playerName: currentNonogram?.playerName || defaultPlayerName,
    difficulty: currentNonogram?.difficulty || "",
    matrix: currentNonogram?.matrix || [],
    currentProgress: currentNonogram?.currentProgress || [],
    truthyCellsIndexes: currentNonogram?.truthyCellsIndexes || [],
    excludedCellsIndexes: currentNonogram?.excludedCellsIndexes || [],
    truthyCells: [],
    falsyCells: [],
  },
};

export default appState;
