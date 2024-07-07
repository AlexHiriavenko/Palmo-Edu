function validateNumberInput(message) {
  let input;
  while (true) {
    input = prompt(message);
    if (input === null) {
      alert("Отмена ввода");
      return null;
    }
    input = parseFloat(input);
    if (!isNaN(input)) {
      return input;
    } else {
      alert("Пожалуйста, введите корректное число");
    }
  }
}

const calculator = {
  add(num1, num2) {
    return num1 + num2;
  },
  subtract(num1, num2) {
    return num1 - num2;
  },
  multiply(num1, num2) {
    return num1 * num2;
  },
  divide(num1, num2) {
    if (num2 === 0) {
      throw new Error("На 0 делить нельзя");
    }
    return num1 / num2;
  },
};

function runCalculator() {
  const MESSAGE_OPERAND1 = "Введите первый операнд:";
  const MESSAGE_OPERAND2 = "Введите второй операнд:";
  const MESSAGE_CANCEL =
    "Вы прервали калькулятор, обновите страницу и попробуйте снова.";

  try {
    const num1 = validateNumberInput(MESSAGE_OPERAND1);
    if (num1 === null) throw new Error(MESSAGE_CANCEL);

    const num2 = validateNumberInput(MESSAGE_OPERAND2);
    if (num2 === null) throw new Error(MESSAGE_CANCEL);

    const results = `
      Результат сложения: ${calculator.add(num1, num2)}
      Результат вычитания: ${calculator.subtract(num1, num2)}
      Результат умножения: ${calculator.multiply(num1, num2)}
      Результат деления: ${calculator.divide(num1, num2)}
    `;

    alert(results);
  } catch (error) {
    alert(error.message);
  }
}

export { validateNumberInput, calculator, runCalculator };
