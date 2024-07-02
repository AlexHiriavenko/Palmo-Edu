function printMultiplicationTable(multiplier = 5) {
  for (let i = 1; i <= 9; i += 1) {
    console.log(`${i} * ${multiplier} = ${i * multiplier}`);
  }
}

export default printMultiplicationTable;
