<?php

const BR = '<br>';

// Створіть масив $arr=['a', 'b', 'c']. Виведіть значення масиву на екран за допомогою функції var_dump().

$arr=['a', 'b', 'c'];
var_dump($arr);

echo BR;

//  За допомогою масиву $arr з попереднього номера виведіть на екран вміст першого, другого і третього елементів.

foreach ($arr as $element) {
    echo $element . "\n"; 
}
echo BR;

// Створіть масив $arr=['a', 'b', 'c', 'd'] і з його допомогою виведіть на екран рядок 'a+b, c+d'.

$arr = ['a', 'b', 'c', 'd'];

echo "{$arr[0]}+{$arr[1]}, {$arr[2]}+{$arr[3]}";
echo BR;

// Створіть масив $arr з елементами 2, 5, 3, 9. 
// Помножте перший елемент масиву на другий, а третій елемент на четвертий. 
// Результати складіть, присвойте змінній $result. Виведіть на екран значення цієї змінної.

$arr = [2, 5, 3, 9];
$result = ($arr[0] * $arr[1]) + ($arr[2] * $arr[3]);
echo $result . BR;

// Заповніть масив $arr числами від 1 до 5. Не оголошуйте масив, а просто заповніть його присвоюванням $arr[] = нове значення.

array_splice($arr, 0); // очищаем массив после прошлых тасков 

$arr[] = 1;
$arr[] = 2;
$arr[] = 3;
$arr[] = 4;
$arr[] = 5;

var_dump($arr);
echo BR;

// Створіть масив $arr. Виведіть на екран елемент із ключем 'c'.

$arr = ['a'=>1, 'b'=>2, 'c'=>3];
echo $arr['c']; // 3
echo BR;

// Знайдіть суму елементів цього масиву.

echo array_sum($arr) . BR; // 6

//  Створіть масив заробітних плат $arr. Виведіть на екран зарплату Петрика та Колі.

$arr = ['Коля'=>'1000$', 'Вася'=>'500$', 'Петя'=>'200$'];

echo "Зарплата Колі: " . $arr['Коля'] . "; ";
echo "Зарплата Петрика: " . $arr['Петя'] . " ";
echo BR;

// Створіть асоціативний масив днів тижня. Ключами в ньому мають слугувати номери днів 
// від початку тижня (понеділок - повинен мати ключ 1 і т.д.). 
// Виведіть на екран поточний день тижня.

$daysOfWeek = [
    1 => 'Понеділок',
    2 => 'Вівторок',
    3 => 'Середа',
    4 => 'Четвер',
    5 => 'П’ятниця',
    6 => 'Субота',
    7 => 'Неділя'
];

echo "Сьогодні: " . $daysOfWeek[date('N')] . BR;

// Нехай тепер номер дня тижня зберігається у змінній $day, наприклад там лежить число 3. Виведіть день тижня, що відповідає значенню змінної $day.

$day = 3;
$targetDay = $daysOfWeek[$day] ?? "Не iснуючий день тижня.";

echo "День тижня №{$day} це {$targetDay}" . BR;

//  Створіть багатовимірний масив $arr. З його допомогою виведіть на екран слова 'joomla', 'drupal', 'зелений', 'червоний'.

$arr = [
  'cms'=>['joomla', 'wordpress', 'drupal'],
  'colors'=>['blue'=>'блакитний', 'red'=>'червоний', 'green'=>'зелений']
];

echo $arr['cms'][0] . " ";
echo $arr['cms'][2] . " ";        
echo $arr['colors']['green'] . " ";
echo $arr['colors']['red'] . " ";
echo BR;

// Створіть двовимірний масив. Перші два ключі - це 'ua' і 'en'. 
// Нехай перший ключ містить елемент, що є масивом назв днів тижня українською, а другий - англійською. 
// Виведіть за допомогою цього масиву понеділок російською та середу англійською (понеділок - це перший день).

$daysOfWeekUa = $daysOfWeek;
$daysOfWeekEn = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$daysOfWeekEn = array_combine(range(1, 7), $daysOfWeekEn);

$arr = [
    'ua' => $daysOfWeekUa,
    'en' => $daysOfWeekEn,
];

echo $arr['ua'][1] . " та "; // Понеділок
echo $arr['en'][3] . " "; // Wednesday

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles.css" rel="stylesheet">
  <title>php scalars</title>

</head>
<body>
  <section>
    <ul>
        <li><a href="../index.php">back to main</a></li>
        <li><a href="./scalars.php">to HW-1 Scalars</a></li>
        <li><a href="../HW-2/functions.php">to HW-2 Functions</a></li>
    </ul>
  </section>
</body>
</html>