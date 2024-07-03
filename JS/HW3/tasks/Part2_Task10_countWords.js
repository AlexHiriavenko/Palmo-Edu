function validateTextInput(message) {
  let input;
  while (true) {
    input = prompt(message);
    if (input === null) {
      alert("Отмена ввода");
      return null;
    }
    if (input.trim() !== "") {
      return input.trim();
    } else {
      alert("Пожалуйста, введите непустой текст");
    }
  }
}

// апостроф потому что "I'm" или "don't" - считаю это как за букву, а слово "I'm" одним словом
function isLetter(char) {
  return char.toLowerCase() !== char.toUpperCase() || char === "'";
}

function countWords() {
  let text = validateTextInput("Введите текст:");
  if (text === null) return;

  // Удаление всех небуквенных символов, заменяя их пробелами
  let cleanedTextArray = text
    .split("")
    .map((char) => (isLetter(char) || char === " " ? char : " "));
  let cleanedText = cleanedTextArray.join("");

  // тут регулярное выражение будет более эффективно чем .split(" ")
  let words = cleanedText.split(/\s+/).filter((word) => word.length > 0);
  let wordCount = words.length;

  alert(`Количество слов в введенном тексте: ${wordCount}`);
}

export default countWords;
