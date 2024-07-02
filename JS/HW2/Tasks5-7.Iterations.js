// 5

function isPrime(n) {
  if (n <= 1) {
    return false;
  }

  for (let i = 2; i <= Math.sqrt(n); i += 1) {
    if (n % i === 0) {
      return false;
    }
  }

  return true;
}

function printPrimeNumbers(start, end) {
  const res = [];
  for (let i = start; i <= end; i++) {
    if (isPrime(i)) {
      res.push(i);
    }
  }
  console.log(res);
}

printPrimeNumbers(1, 500);

// 6

function descendingIteration(start, end) {
  const res = [];
  for (let i = end; i >= start; i -= 1) {
    res.push(i);
  }
  console.log(res);
}

descendingIteration(300, 1000);

// 7;

function askUser(question) {
  return prompt(question);
}

function calcOperationsTable(num) {
  let results = [];

  for (let i = 1; i <= 100; i += 1) {
    results.push({
      number: i,
      addition: num + i,
      subtraction: num - i,
      multiplication: num * i,
      division: +(num / i).toFixed(2),
    });
  }

  console.log(
    `таблица математических операций для числа ${num} с числами от 1 до 100`
  );
  console.table(results);
}

let inputNum = askUser("Введите число:");
calcOperationsTable(+inputNum);
