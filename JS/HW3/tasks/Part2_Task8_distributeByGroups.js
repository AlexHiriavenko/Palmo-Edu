import { validateNumberInput } from "./HELPERS.js";

function distributeByGroups() {
  let studentsQuantity = validateNumberInput("Введите количество студентов:");
  if (studentsQuantity === null) return;

  let groupsQuantity = validateNumberInput("Введите количество групп:");
  if (groupsQuantity === null) return;

  let studentsPerGroup = Math.floor(studentsQuantity / groupsQuantity);
  let remainingStudents = studentsQuantity % groupsQuantity;

  let equalGroups = new Array(groupsQuantity).fill(studentsPerGroup);

  const finalGroups = distributeRemainder(equalGroups, remainingStudents);

  function distributeRemainder(groups, remainder) {
    for (let i = 0; i < remainder; i += 1) {
      groups[i] += 1;
    }
    return groups;
  }

  let resultMessage = "Распределение студентов по группам:\n";
  for (let i = 0; i < finalGroups.length; i += 1) {
    resultMessage += `Группа ${i + 1}: ${finalGroups[i]} студентов\n`;
  }

  alert(resultMessage);
}

export default distributeByGroups;
