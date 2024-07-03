import { validateNumberInput } from "./HELPERS.js";

function calculateInterestIncome() {
  let depositAmount = validateNumberInput("Введите сумму вклада:");
  if (depositAmount === null) return;

  let annualInterestRate = validateNumberInput("Введите годовой процент:");
  if (annualInterestRate === null) return;

  let earn = depositAmount * (annualInterestRate / 100);
  let totalAmount = depositAmount + earn;

  alert(`Сумма вклада через год: ${totalAmount.toFixed(2)}`);
}

export default calculateInterestIncome;
