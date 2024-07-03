import { validateNumberInRange } from "./HELPERS.js";

function getDayOfWeek() {
  const daysOfWeek = {
    1: "Понедельник",
    2: "Вторник",
    3: "Среда",
    4: "Четверг",
    5: "Пятница",
    6: "Суббота",
    7: "Воскресенье",
  };

  let dayNumber = validateNumberInRange("Введите число от 1 до 7:", 1, 7);
  if (dayNumber === null) return;

  alert(`День недели: ${daysOfWeek[dayNumber]}`);
}

export default getDayOfWeek;
