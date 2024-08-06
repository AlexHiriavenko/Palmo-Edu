import { validateNumberInput } from "./HELPERS.js";

function calculateSalaryTaxes(salary, taxRate) {
  return salary * taxRate;
}

function promptCalculateSalaryTaxes() {
  let salary = validateNumberInput("Введите вашу зарплату:");
  if (salary === null) return;

  let taxAmount = calculateSalaryTaxes(salary, 0.05);
  alert(
    `При зарплате ${salary.toFixed(
      2
    )} вы должны заплатить налог в размере ${taxAmount.toFixed(2)}`
  );
}

export default promptCalculateSalaryTaxes;
