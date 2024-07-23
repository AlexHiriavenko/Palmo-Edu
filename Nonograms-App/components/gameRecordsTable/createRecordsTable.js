import { closeModal } from "../modal/functions/closeModal";
import { timer } from "../../js-utilits/timer/timerInstance";

export function createRecordsTable() {
  const container = document.createElement("div");
  container.className = "records-container";

  const h3 = document.createElement("h3");
  h3.textContent = "Records";
  h3.className = "difficulty-label form-title";

  const btn = document.createElement("button");
  btn.className = "control-btn start-game-btn";
  btn.textContent = "OK";
  btn.addEventListener("click", closeModal);

  // Создаем таблицу и заголовок
  const table = document.createElement("table");
  table.className = "records-table";
  const thead = document.createElement("thead");
  const theadRow = document.createElement("tr");

  // Добавляем заголовки
  const headers = ["#", "Player Name", "Nonogram", "Difficulty", "Time"];
  headers.forEach((headerText) => {
    const th = document.createElement("th");
    th.className = "records__th";
    th.textContent = headerText;
    theadRow.appendChild(th);
  });

  thead.appendChild(theadRow);
  table.appendChild(thead);

  // Создаем тело таблицы
  const tbody = document.createElement("tbody");

  // Получаем записи из localStorage
  const records = JSON.parse(localStorage.getItem("recordsTable")) || [];

  // Добавляем строки данных
  for (let i = 0; i < 5; i += 1) {
    const tbodyRow = document.createElement("tr");

    // Добавляем порядковый номер
    const indexCell = document.createElement("td");
    indexCell.textContent = (i + 1).toString();
    tbodyRow.appendChild(indexCell);

    if (records[i]) {
      const record = records[i];

      // Добавляем ячейки данных
      const dataCells = ["playerName", "nonogramName", "difficulty", "time"];
      dataCells.forEach((cellKey) => {
        const td = document.createElement("td");
        if (cellKey === "time" && !isNaN(record[cellKey])) {
          td.textContent = timer.formatTime(record[cellKey]);
        } else {
          td.textContent = record[cellKey];
        }
        tbodyRow.appendChild(td);
      });
    } else {
      // Если записи нет, заполняем ячейки "empty"
      for (let j = 0; j < 4; j += 1) {
        const td = document.createElement("td");
        td.textContent = "empty";
        tbodyRow.appendChild(td);
      }
    }

    tbody.appendChild(tbodyRow);
  }

  table.appendChild(tbody);

  container.append(h3, table, btn);

  return container;
}
