<?php

const BR = '<br>';

// Створіть змінну $a і присвойте їй значення 3. Виведіть значення цієї змінної на екран.

$a = 3;
echo $a; 
echo BR;

// Створіть змінні $a=10 і $b=2. Виведіть на екран їхню суму, різницю, добуток і частку (результат ділення).

$a = 10;
$b = 2;

echo $a + $b;
echo BR;

echo $a - $b;
echo BR;

echo $a * $b;
echo BR;

echo $a / $b;
echo BR;

echo $a % $b;
echo BR;

// Створіть змінні $c=15 і $d=2. Підсумуйте їх, а результат присвойте змінній $result. 
// Виведіть на екран значення змінної $result.

$c = 15;
$d = 2;
$result = $c + $d;
echo $result; // 17
echo BR;

// Створіть змінні $a=10, $b=2 і $c=5. Виведіть на екран їхню суму.

$a = 10;
$b = 2;
$c = 5;
echo $a + $b + $c; // 17
echo BR;

// Створіть змінні $a=17 і $b=10. Відніміть від $a змінну $b і результат присвойте змінній $c. 
// Потім створіть змінну $d, присвойте їй значення 7. 
// Складіть змінні $c і $d, а результат запишіть у змінну $result. 
// Виведіть на екран значення змінної $result.

$a = 17;
$b = 10;
$c = $a - $b;  // 7
$d = 7;
$result = $c + $d; // 14

echo $result;
echo BR;

// Створіть змінну $text і присвойте їй значення 'Привіт, Світ!'. Виведіть значення цієї змінної на екран.
$text = 'Привіт, Світ!';
echo $text;
echo BR;

// Створіть змінні $text1='Привіт, ' і $text2='Світ!'. 
// За допомогою цих змінних і операції додавання рядків виведіть на екран фразу 'Привіт, Мир!'.
$text1 = 'Привіт, ';
$text2 = 'Світ!';
echo $text1 . 'Мир!';
echo BR;

// Створіть змінну $name і присвойте їй ваше ім'я. Виведіть на екран фразу 'Привіт, %Ім'я%!'. 
// Замість %Ім'я% має стояти ваше ім'я.
$name = 'Alex';
echo 'Привіт, ' . $name . '!';
echo BR;

// Створіть змінну $age і присвойте їй ваш вік. Виведіть на екран 'Мені %Вік% років!'.
$age = 39;
echo 'Мені ' . $age . ' років!';
echo BR;

// Створіть змінну $text і присвойте їй значення 'abcde'.
// Звертаючись до окремих символів цього рядка, виведіть на екран символ 'a', символ 'c', символ 'e'.
$text = 'abcde';
echo $text[0]; // символ 'a'
echo BR;
echo $text[2]; // символ 'c'
echo BR;
echo $text[4]; // символ 'e'
echo BR;

// Дано довільний рядок, наприклад, 'abcde'. Поміняйте першу букву (тобто букву 'a') цього рядка на '!'.
$text = 'abcde';
$text[0] = '!';
echo $text; // !bcde
echo BR;

// Створіть змінну $num і присвойте їй значення '12345'. Знайдіть суму цифр цього числа.
$num = '12345';
echo array_sum(str_split($num)); // 15
echo BR;

// Напишіть скрипт, який рахує кількість секунд у годині, у добі, у місяці.

$secondsInHour = 60 * 60;
echo "Кількість секунд у годині: " . number_format($secondsInHour);
echo BR;

$secondsInDay = 24 * $secondsInHour;
echo "Кількість секунд у добі: " . number_format($secondsInDay);
echo BR;

$secondsInMonth = 30 * $secondsInDay;
echo "Кількість секунд у місяці: " . number_format($secondsInMonth);
echo BR;

// Створіть три змінні - година, хвилина, секунда. З їхньою допомогою виведіть поточний час у форматі 'година:хвилина:секунда'.

$currentTime = new DateTime('now', new DateTimeZone('Europe/Kyiv'));

$hour = $currentTime->format('H');
$minute = $currentTime->format('i');
$second = $currentTime->format('s');

echo "Поточний час: $hour:$minute:$second";
echo BR;

// Створіть змінну, присвойте їй число. Підведіть це число до квадрата. 
// Виведіть його на екран.

$number = 5;
echo $number ** 2; //25
echo BR;

// Переробіть код так, щоб у ньому використовувалися операції +=, -=, *=, /=. 
// Кількість рядків коду при цьому не повинна змінитися.

$var = 47;
$var += 7;
$var -= 18;
$var *= 10;
$var /= 20;
echo $var; // 18
echo BR;

// Переробіть код так, щоб у ньому використовувалася операція .=
// Кількість рядків коду при цьому не повинна змінитися.

$text = 'Я';
$text .= ' хочу';
$text .= ' знати';
$text .= ' PHP!';
echo $text;
echo BR;

// Переробіть цей код так, щоб у ньому використовувалися операції ++ і --. 
// Кількість рядків коду при цьому не повинна змінитися.

$var = 10;
$var++;
$var++;
$var--;
echo $var; // 11
echo BR;

// Переробіть цей код так, щоб у ньому використовувалися операції ++, -- , +=, -=, *=, /=. 
// Кількість рядків коду при цьому не повинна змінитися.

$var = 10;
$var += 7;
$var++;
$var--;
$var += 12;
$var *= 7;
$var -= 15;
echo $var;
echo BR;

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
        <li><a href="./arrays.php">to HW-1 Arrays</a></li>
        <li><a href="../HW-2/functions.php">to HW-2 Functions</a></li>
    </ul>
  </section>
</body>
</html>