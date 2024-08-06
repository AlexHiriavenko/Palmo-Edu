import { validateNumberInput } from "./HELPERS.js";

function celsiusToFahrenheit(celsius) {
  return (celsius * 9) / 5 + 32;
}

function promptCelsiusToFahrenheit() {
  let celsius = validateNumberInput("Введите температуру в градусах Цельсия:");
  if (celsius === null) return;

  let fahrenheit = celsiusToFahrenheit(celsius);
  alert("Температура в градусах Фаренгейта: " + fahrenheit.toFixed(2));
}

export default promptCelsiusToFahrenheit;
