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

function validateNumberInRange(message, min, max) {
  let input;
  while (true) {
    input = prompt(message);
    if (input === null) {
      alert("Отмена ввода");
      return null;
    }
    input = parseFloat(input);
    if (!isNaN(input) && input >= min && input <= max) {
      return input;
    } else {
      alert(`Пожалуйста, введите число от ${min} до ${max}`);
    }
  }
}

export { validateNumberInput, validateNumberInRange };
