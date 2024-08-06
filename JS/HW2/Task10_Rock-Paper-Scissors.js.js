const gameRules = {
  камень: {
    камень: "draw",
    ножницы: "win",
    бумага: "defeat",
  },
  ножницы: {
    камень: "defeat",
    ножницы: "draw",
    бумага: "win",
  },
  бумага: {
    камень: "win",
    ножницы: "defeat",
    бумага: "draw",
  },
};

const MESSAGES_END_GAME = {
  defeat: "К сожалению, вы проиграли.",
  win: "Поздравляем! Вы выиграли!",
  draw: "Ничья! Попробуйте еще раз.",
};

function getComputerChoice() {
  let gameRulesKeys = Object.keys(gameRules);
  let randomIndex = Math.floor(Math.random() * gameRulesKeys.length);
  return gameRulesKeys[randomIndex];
}

let userChoice = prompt("Введите Камень, Ножницы или Бумага:");

if (
  userChoice === null ||
  !gameRules.hasOwnProperty(userChoice.trim().toLowerCase())
) {
  alert("Некорректный ввод или игра отменена.");
} else {
  userChoice = userChoice.trim().toLowerCase();

  let computerChoice = getComputerChoice();

  alert(`Вы выбрали: ${userChoice}. Компьютер выбрал: ${computerChoice}.`);

  let result = gameRules[userChoice][computerChoice];

  alert(MESSAGES_END_GAME[result]);
}
