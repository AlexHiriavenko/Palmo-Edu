function isAnagram(str1, str2) {
  const cleanedStr = (str) => {
    return str
      .toLowerCase()
      .replace(/[^a-z0-9]/g, "")
      .split("")
      .sort()
      .join("");
  };

  console.log(cleanedStr(str1) === cleanedStr(str2));
  return cleanedStr(str1) === cleanedStr(str2);
}

export { isAnagram };
