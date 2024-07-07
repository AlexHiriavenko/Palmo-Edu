import { validateNumberInput } from "./HELPERS.js";

function calculateDistance(speed, time) {
  return speed * time;
}

function promptCalculateDistance() {
  let speed = validateNumberInput("Введите скорость (км/ч):");
  if (speed === null) return;

  let time = validateNumberInput("Введите время (часы):");
  if (time === null) return;

  let distance = calculateDistance(speed, time);
  alert(
    `При скорости ${speed} км/ч и времени ${time} ч., вы пройдете расстояние ${distance} км.`
  );
}

export default promptCalculateDistance;
