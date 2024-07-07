import { validateNumberInput } from "./HELPERS.js";

function calculatePercent(number1, number2) {
  return (number1 / number2) * 100;
}

function promptCalculatePercent() {
  let number1 = validateNumberInput("Введите первое число:");
  if (number1 === null) return;

  let number2 = validateNumberInput("Введите второе число:");
  if (number2 === null) return;

  let percent = calculatePercent(number1, number2);
  alert(`${number1} составляет ${percent.toFixed(2)}% от ${number2}`);
}

export default promptCalculatePercent;
