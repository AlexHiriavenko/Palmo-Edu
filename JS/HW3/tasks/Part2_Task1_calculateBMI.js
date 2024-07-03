import { validateNumberInput } from "./HELPERS.js";

function calculateBMI() {
  let weight = validateNumberInput("Введите ваш вес в килограммах:");
  if (weight === null) return;

  let height = validateNumberInput("Введите ваш рост в сантиметрах:");
  if (height === null) return;

  let bmi = weight / ((height / 100) * (height / 100));
  alert("Ваш ИМТ: " + bmi.toFixed(2));
}

export default calculateBMI;
