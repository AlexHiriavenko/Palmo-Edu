function printEvenNumbers(a = 0, b = 20) {
  // т.к. для сокращения кол-ва итераций шаг цикла будет += 2,
  // проверяем начальное значение на четность, и если не четное, то начинаем со следующего четного
  a += a % 2 === 0 ? 0 : 1;

  for (let i = a; i <= b; i += 2) {
    console.log(i);
  }
}

export default printEvenNumbers;
