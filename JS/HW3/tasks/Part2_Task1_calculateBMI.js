import { validateNumberInput } from "./HELPERS.js";

function calculateBMI(weight, height) {
  return weight / ((height / 100) * (height / 100));
}

function promptCalculateBMI() {
  let weight = validateNumberInput("Введите ваш вес в килограммах:");
  if (weight === null) return;

  let height = validateNumberInput("Введите ваш рост в сантиметрах:");
  if (height === null) return;

  let bmi = calculateBMI(weight, height);
  alert("Ваш ИМТ: " + bmi.toFixed(2));
}

export default promptCalculateBMI;
