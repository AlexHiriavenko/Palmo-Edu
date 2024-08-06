function printExceptFourthNumbers(start = 1, end = 100) {
  for (let i = end; i >= start; i--) {
    if ((end - i + 1) % 4 !== 0) {
      console.log(i);
    }
  }
}

export default printExceptFourthNumbers;
