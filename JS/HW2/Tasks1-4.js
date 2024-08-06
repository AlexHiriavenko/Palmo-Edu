// Общие функции и сообщения
function askUser(question) {
  return prompt(question);
}

function informUser(info) {
  alert(info);
}

function isNull(value) {
  return value === null;
}

const messages = {
  cancel: "Ввод отменён",
  incorrectInputValue:
    "Вы ввели некорректное значение или оставили поле пустым. Введите число.",
  userCountry: "Ваша страна проживания?",
  countryNotNumber: "Название не может быть числом",
  enterData: "Введите данные",
  firstNumber: "Проверка Кратности. Введите первое число:",
  secondNumber: "Проверка Кратности. Введите второе число:",
  inputNumber: "Проверка на четность. Введите число:",
  rangeNumber: "Найти четверть в диапазоне. Введите число от 1 до 100",
  outOfRange: "Введенное число не соответствует диапазону от 1 до 100.",
};

function isValidNumber(value) {
  return !isNaN(value) && isFinite(value);
}

// TASK_1
function getUserCountry() {
  let userAnswer = askUser(messages.userCountry);
  while (true) {
    if (isNull(userAnswer)) {
      informUser(messages.cancel);
      break;
    }
    if (userAnswer.trim() === "") {
      informUser(messages.enterData);
    } else if (isValidNumber(userAnswer)) {
      informUser(messages.countryNotNumber);
    } else {
      informUser(`Ок, ваша страна проживания: ${userAnswer}`);
      break;
    }
    userAnswer = askUser(messages.userCountry);
  }
}

// TASK_2
function checkMultiple() {
  let a = askUser(messages.firstNumber);
  while (true) {
    if (isNull(a)) {
      informUser(messages.cancel);
      return;
    }
    if (a.trim() === "" || !isValidNumber(a)) {
      informUser(messages.incorrectInputValue);
    } else {
      a = parseFloat(a);
      break;
    }
    a = askUser(messages.firstNumber);
  }

  let b = askUser(messages.secondNumber);
  while (true) {
    if (isNull(b)) {
      informUser(messages.cancel);
      return;
    }
    if (b.trim() === "" || !isValidNumber(b)) {
      informUser(messages.incorrectInputValue);
    } else {
      b = parseFloat(b);
      break;
    }
    b = askUser(messages.secondNumber);
  }

  let isMultiple = a % b === 0;
  informUser(`Число ${a} ${isMultiple ? "кратно" : "не кратно"} числу ${b}`);
}

// TASK_3
function checkEvenNumber() {
  let inputNum = askUser(messages.inputNumber);
  while (true) {
    if (isNull(inputNum)) {
      informUser(messages.cancel);
      return;
    }
    if (inputNum.trim() === "" || !isValidNumber(inputNum)) {
      informUser(messages.incorrectInputValue);
    } else {
      inputNum = parseFloat(inputNum);
      let isEven = inputNum % 2 === 0;
      informUser(
        `Число ${inputNum} является ${isEven ? "четным" : "нечетным"}`
      );
      break;
    }
    inputNum = askUser(messages.inputNumber);
  }
}

// TASK_4
function checkRangeQuarter() {
  let inputNumFromRange = askUser(messages.rangeNumber);
  while (true) {
    if (isNull(inputNumFromRange)) {
      informUser(messages.cancel);
      return;
    }
    if (inputNumFromRange.trim() === "" || !isValidNumber(inputNumFromRange)) {
      informUser(messages.incorrectInputValue);
    } else if (+inputNumFromRange < 1 || +inputNumFromRange > 100) {
      informUser(messages.outOfRange);
    } else {
      let quarter = Math.ceil(inputNumFromRange / 25);
      informUser(`Число ${inputNumFromRange} находится в ${quarter}й четверти`);
      break;
    }
    inputNumFromRange = askUser(messages.rangeNumber);
  }
}

// Запуск задач
getUserCountry();
checkMultiple();
checkEvenNumber();
checkRangeQuarter();
