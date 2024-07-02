function printFibonacci(a = 1, b = 1, maxValue = 1000) {
  let sum = a + b;

  while (sum <= maxValue) {
    console.log(sum);
    a = b;
    b = sum;
    sum = a + b;
  }
}

export default printFibonacci;
