class MathOperations {
  add(firstOperand, secondOperand) {
    return firstOperand + secondOperand;
  }

  subtract(firstOperand, secondOperand) {
    return firstOperand - secondOperand;
  }

  multiply(firstOperand, secondOperand) {
    return firstOperand * secondOperand;
  }

  divide(firstOperand, secondOperand) {
    if (secondOperand === 0) {
      throw new Error("Cannot divide by zero");
    }
    return firstOperand / secondOperand;
  }

  get methodsList() {
    return {
      "+": this.add,
      "-": this.subtract,
      "×": this.multiply,
      "÷": this.divide,
    };
  }
}

class Calculator {
  constructor() {
    this.display = document.getElementById("calc-screen");
    this.resetButton = document.querySelector(".reset button");
    this.resultButton = document.querySelector(
      ".grid-item.operation-equal button"
    );
    this.operandButtons = document.querySelectorAll(
      ".grid-item.operand button"
    );
    this.operationButtons = document.querySelectorAll(
      ".grid-item.operation-mark button"
    );
    this.reset();
  }

  init() {
    this.operandButtons.forEach((btn) =>
      btn.addEventListener("click", () => this.onOperandClick(btn.textContent))
    );
    this.operationButtons.forEach((btn) =>
      btn.addEventListener("click", () =>
        this.onOperationClick(btn.textContent)
      )
    );
    this.resetButton.addEventListener("click", () => this.reset());
    this.resultButton.addEventListener("click", () => this.onResultClick());
  }

  reset() {
    this.currentInput = "0";
    this.firstOperand = "";
    this.secondOperand = "";
    this.operation = null;
    this.result = null;
    this.waitingForSecondOperand = false;
    this.wasEqualPressed = false;
    this.errorState = false;
    this.updateDisplay(this.currentInput);
    window.console.clear();
  }

  updateDisplay(value) {
    this.display.value = value;
  }

  calculate() {
    const mathOperations = new MathOperations();
    const currentMathMethod = mathOperations.methodsList[this.operation];
    if (currentMathMethod) {
      try {
        this.result = currentMathMethod(
          +this.firstOperand,
          +this.secondOperand
        );
        this.updateDisplay(this.result);
        return this.result;
      } catch (error) {
        this.updateDisplay("Error");
        this.errorState = true;
        return;
      }
    } else {
      console.log("Invalid operation");
    }
  }

  handleDecimal() {
    if (!this.waitingForSecondOperand) {
      if (!this.firstOperand.includes(".")) {
        this.firstOperand += this.firstOperand ? "." : "0.";
        this.currentInput = this.firstOperand;
        this.updateDisplay(this.firstOperand);
      }
    } else {
      if (!this.secondOperand.includes(".")) {
        this.secondOperand += this.secondOperand ? "." : "0.";
        this.currentInput = this.secondOperand;
        this.updateDisplay(this.secondOperand);
      }
    }
  }

  onOperandClick(operand) {
    if (this.wasEqualPressed || this.errorState) {
      this.reset();
    }

    if (operand === ".") {
      this.handleDecimal();
      return;
    }

    if (!this.waitingForSecondOperand) {
      this.currentInput =
        this.currentInput === "0" ? operand : this.currentInput + operand;
      this.firstOperand = this.currentInput;
      this.updateDisplay(this.firstOperand);
    } else {
      this.currentInput =
        this.currentInput === "0" ? operand : this.currentInput + operand;
      this.secondOperand = this.currentInput;
      this.updateDisplay(this.secondOperand);
    }
  }

  onOperationClick(operation) {
    if (this.errorState) {
      this.reset();
      return;
    }

    if (this.firstOperand && this.secondOperand) {
      this.calculate();
      this.firstOperand = this.result;
      this.secondOperand = "";
    }

    this.operation = operation;
    this.waitingForSecondOperand = true;
    this.currentInput = "0";
    this.wasEqualPressed = false;
  }

  onResultClick() {
    if (this.firstOperand && this.secondOperand) {
      this.calculate();
      this.firstOperand = this.result;
      this.secondOperand = "";
      this.wasEqualPressed = true;
      this.currentInput = "0";
    }
  }
}

const calculator = new Calculator();
calculator.init();
