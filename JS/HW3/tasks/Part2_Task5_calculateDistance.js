import { validateNumberInput } from "./HELPERS.js";

function calculateDistance() {
  let speed = validateNumberInput("Введите скорость (км/ч):");
  if (speed === null) return;

  let time = validateNumberInput("Введите время (часы):");
  if (time === null) return;

  let distance = speed * time;
  alert(
    `При скорости ${speed} км/ч и времени ${time} ч., вы пройдете расстояние ${distance} км.`
  );
}

export default calculateDistance;
