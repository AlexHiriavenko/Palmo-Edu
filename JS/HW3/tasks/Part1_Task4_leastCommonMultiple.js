// универсальная функция для поиска НОК у скольких угодно чисел:

function leastCommonMultiple(numbers) {
  // 1) я не знаю как числа будут передаваться в функцию: как массив чисел или как числа через запятую;

  numbers = Array.isArray(numbers) ? numbers : [...arguments];

  // 2) НОК(lcm) не может быть меньше сомого большого числа в массиве, поэтому начальное значение НОК:

  let lcm = Math.max(...numbers);

  // 3) цикл в котором будем находить lcm.

  const isLCM = (lcm, numbers) => numbers.every((num) => lcm % num === 0);

  while (true) {
    if (isLCM(lcm, numbers)) {
      console.log(lcm);
      return lcm;
    } else {
      lcm += 1;
    }
  }
}

export default leastCommonMultiple;
