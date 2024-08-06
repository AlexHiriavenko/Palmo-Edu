function isNull(value) {
  return value === null;
}

class Calculator {
  constructor(num1, operation, num2) {
    this.num1 = num1;
    this.num2 = num2;
    this.operation = operation;
  }

  add() {
    return this.num1 + this.num2;
  }

  subtract() {
    return this.num1 - this.num2;
  }

  multiply() {
    return this.num1 * this.num2;
  }

  divide() {
    if (this.num2 === 0) {
      throw new Error("На 0 делить нельзя");
    }
    return this.num1 / this.num2;
  }

  calculate() {
    const operations = {
      "+": this.add.bind(this),
      "-": this.subtract.bind(this),
      "*": this.multiply.bind(this),
      "/": this.divide.bind(this),
    };
    if (!operations[this.operation]) {
      throw new Error("Некорректная операция");
    }
    return operations[this.operation]();
  }
}

function askNumber(message) {
  let input = prompt(message);
  while (true) {
    if (isNull(input)) {
      throw new Error(MESSAGE_CANCEL);
    }
    if (input.trim() && !isNaN(input.trim())) {
      return parseFloat(input);
    }
    input = prompt("Вы ввели не число. Введите число:");
  }
}

function askOperation(message) {
  let operation = prompt(message);
  while (true) {
    if (isNull(operation)) {
      throw new Error(MESSAGE_CANCEL);
    }
    if (["+", "-", "*", "/"].includes(operation.trim())) {
      return operation.trim();
    }
    operation = prompt("Вы ввели неверную операцию, введите одну из - + * /:");
  }
}

const MESSAGE_OPERAND1 = "Введите первый операнд:";
const MESSAGE_OPERATION = "Введите математическую операцию (+, -, *, /):";
const MESSAGE_OPERAND2 = "Введите второй операнд:";
const MESSAGE_CANCEL =
  "Вы прервали калькулятор, обновите страницу и попробуйте снова.";

try {
  const num1 = askNumber(MESSAGE_OPERAND1);
  const operation = askOperation(MESSAGE_OPERATION);
  const num2 = askNumber(MESSAGE_OPERAND2);

  const calculator = new Calculator(num1, operation, num2);
  const result = calculator.calculate();
  alert(`Результат операции: ${result}`);
} catch (error) {
  alert(error.message);
}
