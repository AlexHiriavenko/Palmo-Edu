function printPowersOfNumber(basis = 2, maxPower = 10) {
  for (let power = 1; power <= maxPower; power += 1) {
    console.log(`${basis} ^ ${power} = ${Math.pow(basis, power)}`);
  }
}

export default printPowersOfNumber;
