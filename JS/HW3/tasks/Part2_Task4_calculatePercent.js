import { validateNumberInput } from "./HELPERS.js";

function calculatePercent() {
  let number1 = validateNumberInput("Введите первое число:");
  if (number1 === null) return;

  let number2 = validateNumberInput("Введите второе число:");
  if (number2 === null) return;

  let percent = (number1 / number2) * 100;
  alert(`${number1} составляет ${percent.toFixed(2)}% от ${number2}`);
}

export default calculatePercent;
