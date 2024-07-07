function isPalindrome(str) {
  // регулярное выражение убирает все не алфавитные символы
  const cleanedStr = str.toLowerCase().replace(/[^a-z0-9]/g, "");

  const reversedStr = cleanedStr.split("").reverse().join("");

  console.log(cleanedStr === reversedStr);
  return cleanedStr === reversedStr;
}

export { isPalindrome };
