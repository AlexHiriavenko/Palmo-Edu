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

function isLetter(char) {
  return char.toLowerCase() !== char.toUpperCase() || char === "'";
}

function countWords(text) {
  let cleanedTextArray = text
    .split("")
    .map((char) => (isLetter(char) || char === " " ? char : " "));
  let cleanedText = cleanedTextArray.join("");

  let words = cleanedText.split(/\s+/).filter((word) => word.length > 0);
  return words.length;
}

function promptCountWords() {
  let text = validateTextInput("Введите текст:");
  if (text === null) return;

  let wordCount = countWords(text);
  alert(`Количество слов в введенном тексте: ${wordCount}`);
}

export default promptCountWords;
