function sumOfDigits(num) {
  return num
    .toString()
    .split("")
    .reduce((sum, digit) => sum + parseInt(digit), 0);
}

function findNumbers() {
  const result = [];
  for (let i = 2; i <= 10000; i += 1) {
    if (i % sumOfDigits(i) === 0) {
      result.push(i);
    }
  }
  console.log(result);
  return result;
}

export default findNumbers;
