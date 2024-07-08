function isPalindrome(str) {
  const lowerStr = str.toLowerCase();

  const reversedStr = lowerStr.split("").reverse().join("");

  console.log(lowerStr === reversedStr);
  return lowerStr === reversedStr;
}

export { isPalindrome };
