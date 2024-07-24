import { sortRecords } from "./sortRecord";

export function writeRecord(gameResults) {
  const records = JSON.parse(localStorage.getItem("recordsTable")) || [];

  records.push(gameResults);

  const sortedRecords = sortRecords(records);

  // топ 5 игроков
  while (sortedRecords.length > 5) {
    sortedRecords.pop();
  }

  localStorage.setItem("recordsTable", JSON.stringify(sortedRecords));
}
