function guessNumber() {
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
      let attempts = parseInt(prompt("Введите количество попыток:"));

      if (attempts === null || isNaN(attempts) || attempts <= 0) {
        alert("Игра отменена или введены некорректные данные.");
      } else {
        let prizeAmount =
          (endRange - startRange) * 0.1 + amount - attempts * 0.05;
        let userGuess;
        let randomNumber =
          Math.floor(Math.random() * (endRange - startRange + 1)) + startRange;

        for (let i = 1; i <= attempts; i++) {
          let input = prompt(
            `Введите число от ${startRange} до ${endRange} (Попытка №${i}):`
          );

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
            if (userGuess === randomNumber) {
              alert(
                `Поздравляем! Вы угадали число ${randomNumber} и выиграли ${prizeAmount} баксов`
              );
              break;
            } else if (i === attempts) {
              alert(
                `Вы не угадали. Правильное число было: ${randomNumber}. Вы проиграли.`
              );
            } else {
              alert(`Вы не угадали. Попытка №${i}.`);
            }
          } else {
            alert(
              `Некорректный ввод. Пожалуйста, введите число от ${startRange} до ${endRange}.`
            );
            i--; // Не считать некорректный ввод за попытку
          }
        }
      }
    }
  }
}

export default guessNumber;
