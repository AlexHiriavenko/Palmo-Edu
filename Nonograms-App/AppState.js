const currentNonogram =
  JSON.parse(localStorage.getItem("currentNonogram")) || null;

const appState = {
  nonogram: {
    name: currentNonogram?.name || "",
    playerName: currentNonogram?.playerName || "uknown player",
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
