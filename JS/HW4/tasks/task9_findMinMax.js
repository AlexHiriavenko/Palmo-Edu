function findMinMax(numbers) {
  if (!Array.isArray(numbers)) {
    throw new Error("переданный тип данных НЕ массив");
  }

  const res = {
    max: Math.max(...numbers),
    min: Math.min(...numbers),
  };

  console.log(res);
  return res;
}

export { findMinMax };
