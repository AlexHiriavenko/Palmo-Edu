function printEvenNumbers(a = 0, b = 20) {
  for (let i = a; i <= b; i += 1) {
    if (i % 2 === 0) {
      console.log(i);
    }
  }
}

export default printEvenNumbers;
