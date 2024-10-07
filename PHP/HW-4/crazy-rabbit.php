<?php

const BR = '<br>';

// Задача НЕ решена самостоятельно - решение подсмотрено на codewars в js и переделано на php.


function crazyRabbit(array $field, int $pos): bool {
    // Счётчик итераций основного цикла.
    // Ограничивает количество прыжков для предотвращения бесконечного цикла (лимит — 500 итераций).
    $counter = 0;

    // Мощность прыжка кролика, которая увеличивается с количеством съеденных бобов на текущей позиции.
    $jumpPower = 0;

    // Направление прыжка. 1 — вправо, -1 — влево.
    $direction = 1;

    // Цикл продолжается, пока в поле остаются бобы и количество итераций меньше 500 (ограничение для предотвращения бесконечного цикла).
    while (beansInField($field) && $counter++ < 500) {
        // Мощность прыжка увеличивается на количество бобов в текущей ячейке ($field[$pos]).
        $jumpPower += $field[$pos];

        // Кролик съедает все бобы в текущей ячейке, очищая её (ставя в 0).
        $field[$pos] = 0;

        // Внутренний цикл перемещает кролика на одну клетку в зависимости от мощности прыжка и направления.
        for ($i = 0; $i < $jumpPower; $i++) {
            // Кролик движется на одну позицию в зависимости от направления (вправо или влево).
            $pos += $direction;

            // Если кролик перемещается за правую границу поля, направление меняется на противоположное (влево),
            // и кролик смещается на одну клетку назад.
            if ($pos > count($field) - 1) {
                $direction = -1;
                $pos -= 1;
            }
            // Если кролик перемещается за левую границу, направление меняется на противоположное (вправо),
            // и кролик смещается на одну клетку вперёд.
            elseif ($pos < 0) {
                $direction = 1;
                $pos += 1;
            }
        }
    }

    // Цикл завершается, когда все бобы съедены, и функция возвращает true.
    // Цикл продолжается, если остались несъеденные бобы и счетчик итераций (counter) не достиг 500.
    // Цикл завершится с false, если за 500 итераций не удалось съесть все бобы.
    return beansInField($field) == false;
}

// Проверка остались ли несъеденные бобы.
function beansInField(array $field): bool {
    return array_sum($field) > 0;
}

// Примеры тестов
var_export(crazyRabbit([1, 0, 1], 0)); // true
echo BR;
var_export(crazyRabbit([1, 0, 0, 1], 0)); // true
echo BR;
var_export(crazyRabbit([3, 0, 0, 3], 0)); // true
echo BR;
var_export(crazyRabbit([1, 3, 7], 0)); // true
echo BR;
var_export(crazyRabbit([2, 2, 4, 1, 5, 2, 7], 0)); // false
echo BR;
var_export(crazyRabbit([2, 0, 2, 0, 0, 0, 1], 0)); // true
echo BR;
var_export(crazyRabbit([2, 0, 3, 0, 0, 1, 0], 0)); // true

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles.css" rel="stylesheet">
  <title>php crazy rabbit</title>

</head>

<body>
  <section>
    <h1>Crazy Rabbit</h1>
    <ul>
      <li><a href="../index.php">back to Main</a></li>
    </ul>
  </section>
</body>

</html>