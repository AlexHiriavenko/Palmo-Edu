import { validateNumberInput } from "./HELPERS.js";

function calculateInterestIncome(depositAmount, annualInterestRate) {
  let earn = depositAmount * (annualInterestRate / 100);
  return depositAmount + earn;
}

function promptCalculateInterestIncome() {
  let depositAmount = validateNumberInput("Введите сумму вклада:");
  if (depositAmount === null) return;

  let annualInterestRate = validateNumberInput("Введите годовой процент:");
  if (annualInterestRate === null) return;

  let totalAmount = calculateInterestIncome(depositAmount, annualInterestRate);
  alert(`Сумма вклада через год: ${totalAmount.toFixed(2)}`);
}

export default promptCalculateInterestIncome;
