<?php

const BR = '<br>';

function max_sumDig(int $nMax, int $maxSum): array
{
  // Если maxSum = 0 или nMax < 1000, сразу возвращаем результат
  if ($maxSum === 0 || $nMax < 1000) {
    return [0, 0, 0];
  }

  $sequenceLength = 4; // Длина последовательности цифр для суммирования
  $validNumbers = []; // Массив для хранения подходящих чисел

  // Проверяем каждое число от 1000 до nMax
  for ($i = 1000; $i <= $nMax; $i += 1) {
    $digits = array_map('intval', str_split($i)); // Разбиваем число на цифры

    // Оптимизация: проверяем первые цифры до выполнения основного цикла
    // Если первая цифра уже больше maxSum, можно пропустить число
    if ($digits[0] > $maxSum) {
      continue;
    }

    // Проверяем сумму первых 2 цифр
    if ($digits[0] + $digits[1] > $maxSum) {
      continue;
    }

    // Проверяем суммы последовательных 4-х цифр
    $valid = true;
    for ($j = 0; $j <= count($digits) - $sequenceLength; $j += 1) {
      $sum = array_sum(array_slice($digits, $j, $sequenceLength));
      if ($sum > $maxSum) {
        $valid = false;
        break;
      }
    }

    // Если число прошло проверку, добавляем его в массив
    if ($valid) {
      $validNumbers[] = $i;
    }
  }

  // (1) Количество чисел
  $count = count($validNumbers);

  // Если не найдено подходящих чисел
  if ($count === 0) {
    return [0, 0, 0];
  }

  // (3) Сумма всех чисел
  $totalSum = array_sum($validNumbers);
  // (2) Найти число, ближайшее к среднему значению
  $average = $totalSum / $count;
  $closest = $validNumbers[0];

  foreach ($validNumbers as $num) {
    if (abs($num - $average) < abs($closest - $average)) {
      $closest = $num;
    } elseif (abs($num - $average) == abs($closest - $average) && $num < $closest) {
      $closest = $num;
    }
  }

  return [$count, $closest, $totalSum];
}




// Примеры использования
print_r(max_sumDig(2000, 3)); // Ожидаемый результат: [11, 1110, 12555]
echo BR;
print_r(max_sumDig(2000, 4)); // Ожидаемый результат: [21, 1120, 23665]
echo BR;
print_r(max_sumDig(2000, 7)); // Ожидаемый результат: [85, 1200, 99986]
echo BR;
print_r(max_sumDig(3000, 7)); // Ожидаемый результат: [141, 1600, 220756]
echo BR;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles.css" rel="stylesheet">
  <title>php max_sumDig</title>

</head>

<body>
  <h1>max_sumDig</h1>
  <section>
    <ul>
      <li><a href="../index.php">back to Main</a></li>
    </ul>
  </section>
</body>

</html>