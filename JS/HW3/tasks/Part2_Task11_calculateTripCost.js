import { validateNumberInput } from "./HELPERS.js";

function calculateTripCost(distance, fuelConsumption, fuelPrice) {
  return (distance / 100) * fuelConsumption * fuelPrice;
}

function promptCalculateTripCost() {
  let distance = validateNumberInput("Введите расстояние поездки (в км):");
  if (distance === null) return;

  let fuelConsumption = validateNumberInput(
    "Введите расход топлива (литров на 100 км):"
  );
  if (fuelConsumption === null) return;

  let fuelPrice = validateNumberInput(
    "Введите цену топлива (за литр) в тугриках:"
  );
  if (fuelPrice === null) return;

  let cost = calculateTripCost(distance, fuelConsumption, fuelPrice);
  alert(`Стоимость поездки: ${cost.toFixed(2)} тугриков`);
}

export default promptCalculateTripCost;
