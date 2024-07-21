const currentNonogram =
  JSON.parse(localStorage.getItem("currentNonogram")) || null;

const appState = {
  nonogram: {
    name: "",
    playerName: "uknown player",
    difficulty: "",
    matrix: [],
    currentProgress: currentNonogram?.currentProgress || [],
    truthyCellsIndexes: currentNonogram?.truthyCellsIndexes || [],
    excludedCellsIndexes: currentNonogram?.excludedCellsIndexes || [],
    truthyCells: [],
    falsyCells: [],
  },
};

export default appState;
