function findMinMax(numbers) {
  const res = {
    max: Math.max(...numbers),
    min: Math.min(...numbers),
  };

  console.log(res);
  return res;
}

export { findMinMax };
