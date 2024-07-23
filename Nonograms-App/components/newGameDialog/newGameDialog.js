import { closeModal } from "../modal/functions/closeModal";
import { updateNonogramOptions } from "./functions/updateNonogramOptions";
import { setNonogramState } from "../../js-utilits/appState/setNonogramState";
import { nonograms } from "../nonograms/nonogramsMatrix";
import { arrFillZeros } from "../../js-utilits/nonograms/arrayFillZeros";
import { renderNonogramTable } from "../nonogramTable/nonogramTable";
import { resetNonogramState } from "../../js-utilits/appState/resetNonogramState";
import { table } from "../nonogramTable/nonogramTable";
import appState from "../../AppState";

export function createNewGameDialog() {
  const template = document.getElementById("newGameDialog");
  const newGameDialog = template.content.cloneNode(true);

  const newGameForm = newGameDialog.querySelector("form.start-game-form");

  const difficultySelect = newGameForm.querySelector("#difficulty-select");

  const nonogramSelect = newGameForm.querySelector("#nonogram-names-select");
  const playerNameInput = newGameForm.querySelector("#playerName");

  difficultySelect.addEventListener("change", () => {
    const difficulty = difficultySelect.value;
    updateNonogramOptions(nonogramSelect, difficulty);
  });

  newGameForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const nonogramName = nonogramSelect.value;
    const difficulty = difficultySelect.value;
    const matrix = nonograms[difficulty].find(
      ({ name }) => name === nonogramName
    ).matrix;

    const gameSettings = {
      name: nonogramName,
      difficulty: difficulty,
      playerName: playerNameInput.value.trim() || "uknown player",
      matrix: matrix,
      currentProgress: arrFillZeros(matrix.length),
    };

    resetNonogramState();
    setNonogramState(gameSettings);
    localStorage.setItem("currentNonogram", JSON.stringify(gameSettings));

    closeModal();

    table.style.pointerEvents = "all";
    renderNonogramTable();
  });

  return newGameDialog;
}
