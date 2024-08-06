import { createTableHeadTop } from "./functions/createTableHeadTop";
import { createTableBody } from "./functions/createTableBody";

const table = document.getElementById("table");

function renderNonogramTable() {
  table.innerHTML = "";
  const tableHeader = createTableHeadTop();
  const tableBody = createTableBody();

  table.append(tableHeader, tableBody);
}

export { table, renderNonogramTable };
