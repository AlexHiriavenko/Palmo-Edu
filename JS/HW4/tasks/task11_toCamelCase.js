function toCamelCase(str) {
  const res = str
    .toLowerCase()
    .split(" ")
    .map((word, index) => {
      if (index === 0) {
        // Первое слово оставляем как есть
        return word;
      }
      return word.charAt(0).toUpperCase() + word.slice(1);
    })
    .join("");

  console.log(res);
  return res;
}

export { toCamelCase };
