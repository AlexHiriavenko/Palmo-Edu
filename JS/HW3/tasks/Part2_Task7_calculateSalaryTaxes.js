import { validateNumberInput } from "./HELPERS.js";

function calculateSalaryTaxes() {
  let salary = validateNumberInput("Введите вашу зарплату:");
  if (salary === null) return;

  const taxRate = 0.05;
  let taxAmount = salary * taxRate;

  alert(
    `При зарплате ${salary.toFixed(
      2
    )} вы должны заплатить налог в размере ${taxAmount.toFixed(2)}`
  );
}

export default calculateSalaryTaxes;
