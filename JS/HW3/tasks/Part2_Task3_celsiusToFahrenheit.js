import { validateNumberInput } from "./HELPERS.js";

function celsiusToFahrenheit() {
  let celsius = validateNumberInput("Введите температуру в градусах Цельсия:");
  if (celsius === null) return;

  let fahrenheit = (celsius * 9) / 5 + 32;
  alert("Температура в градусах Фаренгейта: " + fahrenheit.toFixed(2));
}

export default celsiusToFahrenheit;
