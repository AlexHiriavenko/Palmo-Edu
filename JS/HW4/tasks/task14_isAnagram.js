function isAnagram(str1, str2) {
  const sortedStr = (str) => str.toLowerCase().split("").sort().join("");

  console.log(sortedStr(str1) === sortedStr(str2));
  return sortedStr(str1) === sortedStr(str2);
}

export { isAnagram };
