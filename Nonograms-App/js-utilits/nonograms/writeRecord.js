import { sortRecords } from "./sortRecord";

export function writeRecord(gameResults) {
  const records = JSON.parse(localStorage.getItem("recordsTable")) || [];

  records.push(gameResults);

  const sortedRecords = sortRecords(records);

  while (sortedRecords.length > 5) {
    sortedRecords.pop();
  }

  localStorage.setItem("recordsTable", JSON.stringify(sortedRecords));
}
