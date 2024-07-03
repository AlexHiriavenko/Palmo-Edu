import { validateNumberInput } from "./HELPERS.js";

function multiplicationQuiz() {
  let number1 = Math.floor(Math.random() * 10) + 1;
  let number2 = Math.floor(Math.random() * 10) + 1;
  let correctAnswer = number1 * number2;

  let userAnswer = validateNumberInput(
    `Сколько будет ${number1} * ${number2}?`
  );
  if (userAnswer === null) return;

  if (userAnswer === correctAnswer) {
    alert("Правильно!");
  } else {
    alert(`Неправильно. Правильный ответ: ${correctAnswer}`);
  }
}

export default multiplicationQuiz;
