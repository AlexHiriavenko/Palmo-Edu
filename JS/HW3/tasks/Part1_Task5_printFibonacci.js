function printFibonacci(a = 1, b = 1, maxValue = 1000) {
  console.log(a);
  console.log(b);
  let sum = a + b;

  while (sum <= maxValue) {
    console.log(sum);
    a = b;
    b = sum;
    sum = a + b;
  }
}

export default printFibonacci;
