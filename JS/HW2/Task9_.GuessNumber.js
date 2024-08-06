let amount = parseFloat(
  prompt("Введите сумму денег, которую вы хотите поставить на игру:")
);

if (amount === null || isNaN(amount)) {
  alert("Игра отменена или введены некорректные данные.");
} else {
  let startRange = parseInt(
    prompt("Введите начало диапазона чисел (целое число):")
  );
  let endRange = parseInt(
    prompt("Введите конец диапазона чисел (целое число больше начала):")
  );

  if (
    startRange === null ||
    endRange === null ||
    isNaN(startRange) ||
    isNaN(endRange) ||
    startRange >= endRange
  ) {
    alert("Игра отменена или введены некорректные данные.");
  } else {
    let prizeAmount = (endRange - startRange) * 0.1 + amount;
    let userGuess;

    while (true) {
      let input = prompt(`Введите число от ${startRange} до ${endRange}:`);

      if (input === null) {
        alert("Игра отменена.");
        break;
      }

      userGuess = parseInt(input);

      if (
        !isNaN(userGuess) &&
        userGuess >= startRange &&
        userGuess <= endRange
      ) {
        break;
      } else {
        alert(
          `Некорректный ввод. Пожалуйста, введите число от ${startRange} до ${endRange}.`
        );
      }
    }

    if (userGuess === undefined) {
      alert("Игра отменена или введены некорректные данные.");
    } else {
      let randomNumber =
        Math.floor(Math.random() * (endRange - startRange + 1)) + startRange;

      if (userGuess === randomNumber) {
        alert(
          `Поздравляем! Вы угадали число ${randomNumber} и выиграли ${prizeAmount} баксов`
        );
      } else {
        alert(
          `Вы не угадали. Правильное число было: ${randomNumber}. Вы проиграли.`
        );
      }
    }
  }
}
