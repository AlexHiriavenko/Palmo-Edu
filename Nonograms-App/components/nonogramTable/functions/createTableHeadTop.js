import { rotateMatrix } from "./rotateMatrix";
import { calcShadedCells } from "./calcShadedCells";
import appState from "../../../AppState";
import { createHowToPlayDialog } from "../../howToPlayDialog/howToPlay";
import { appendModalContent } from "../../modal/functions/appendModalContent";
import { openModal } from "../../modal/functions/openModal";

export function createTableHeadTop() {
  const matrix = appState.nonogram.matrix;
  // для заголовка вверху для правильного подсчета закрашенных ячеек нужно перевернуть матрицу
  const rotatedMatrix = rotateMatrix(matrix);

  const thead = document.createElement("thead");
  const tr = document.createElement("tr");

  for (let i = 0; i <= matrix.length; i++) {
    const th = document.createElement("th");
    th.className = `th_top ${appState.nonogram.difficulty}`;

    // ячейка верхний левый угол, тут будет справка-popup как играть
    if (i === 0) {
      const helpBtn = document.createElement("button");
      helpBtn.textContent = "?";
      helpBtn.title = "HELP";
      helpBtn.addEventListener("click", () => {
        const howToPlayDialog = createHowToPlayDialog();
        appendModalContent(howToPlayDialog);
        openModal("confirm");
      });
      th.appendChild(helpBtn);
    }

    // вертикальный заголовок сверху
    if (i > 0 && rotatedMatrix[i - 1]) {
      const shadedCellsContent = calcShadedCells(rotatedMatrix[i - 1]);
      th.innerHTML = shadedCellsContent.replace(/\s/g, "<br>"); // риплейс пробел -> br
    }

    tr.appendChild(th);
  }
  thead.appendChild(tr);

  return thead;
}
