import appState from "../../../AppState";
import { calcShadedCells } from "./calcShadedCells";
import { tableBodyLeftClick } from "./tableBodyLeftClick";
// import { tableBodyRightClick } from "./tableBodyRightClick";
import { timer } from "../../../js-utilits/timer/timerInstance";

export function createTableBody() {
  const cells = [];
  const falsyCells = [];
  const truthyCells = [];

  const tbody = document.createElement("tbody");
  const matrix = appState.nonogram.matrix;

  for (let i = 0; i < matrix.length; i++) {
    const tr = document.createElement("tr");

    for (let j = 0; j <= matrix.length; j++) {
      let cell;
      // Горизонтальный заголовок слева
      if (j === 0) {
        cell = document.createElement("th");
        cell.classList.add("th_left", appState.nonogram.difficulty);
        cell.textContent = calcShadedCells(matrix[i]);
      } else {
        // Тело таблицы
        cell = document.createElement("td");
        // акцентная граница для блока 5х5
        cell.classList.add("td", appState.nonogram.difficulty);
        if (j % 5 === 0 && matrix.length > 5 && j !== matrix[i].length) {
          cell.classList.add("border5x5V");
        }
        if ((i + 1) % 5 === 0 && matrix.length > 5 && i + 1 !== matrix.length) {
          cell.classList.add("border5x5H");
        }
        // для showSolution, чтобы опять не бегать циклами:
        // собираем в отдельный массив все "правдивые" ячейки
        if (matrix[i][j - 1] === 1) {
          truthyCells.push(cell);
        }
        // собираем в отдельный массив все "ложные" ячейки
        if (matrix[i][j - 1] === 0) {
          falsyCells.push(cell);
        }
        cells.push(cell);
      }
      tr.appendChild(cell);
    }

    tbody.appendChild(tr);
  }

  tbody.addEventListener("click", (event) => tableBodyLeftClick(event, cells));
  // tbody.addEventListener("contextmenu", (event) =>
  //   tableBodyRightClick(event, cells)
  // );

  function startTimer(event) {
    if (!timer.isRunning && event.target.nodeName === "TD") {
      timer.start();
    }
  }

  tbody.addEventListener("click", startTimer, { once: true });
  tbody.addEventListener(
    "contextmenu",
    (event) => {
      event.preventDefault();
      startTimer(event);
    },
    { once: true }
  );

  appState.nonogram.truthyCells = truthyCells;
  appState.nonogram.falsyCells = falsyCells;

  return tbody;
}
