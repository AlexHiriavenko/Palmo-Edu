<?php

const BR = '<br>';

// Створіть функцію, яка обчислює середнє арифметичне значення з масиву чисел.

function array_average(array $numbers): float {
    return empty($numbers) ? 0.0 : array_sum($numbers) / count($numbers);
}

$average = array_average([10, 20, 30, 40]); // 50
echo "Середнє арифметичне: " . $average . BR;

// Напишіть функцію для перевертання рядка.

function reverseString(string $str): string {
    $isAscii = preg_match('/^[\x00-\x7F]*$/', $str) === 1;
    if ($isAscii) {
      return strrev($str);
    }
    
    preg_match_all('/./us', $str, $ar);

    return join('', array_reverse($ar[0]));
}

echo reverseString("Привіт!"); // !тівирП
echo BR;

// Створіть функцію, яка приймає масив чисел і повертає новий масив, в якому всі елементи збільшені на 10.

function increaseByTen(array $numbers): array {
    return array_map(fn($num) => $num + 10, $numbers);
}

$originalArray = [1, 2, 3, 4, 5];
$newArray = increaseByTen($originalArray);

print_r($newArray); // [11, 12, 13, 14, 15]
echo BR;

// Напишіть функцію для визначення кількості голосних літер у рядку.

function countLatinVowels(string $str): int {
    $str = mb_strtolower($str);
    preg_match_all('/[aeiou]/', $str, $matches);
    
    return count($matches[0]);
}

$vowelCount = countLatinVowels("Hello, how are you?");
echo "Кількість голосних латинських літер: " . $vowelCount; // 7

// Створіть функцію для видалення дублікатів з масиву.

function removeDuplicates(array $arr): array {
    return array_values(array_unique($arr));
}

$uniqueArray = removeDuplicates([1, 2, 2, 3, 4, 4, 5]);

print_r($uniqueArray); // [1, 2, 3, 4, 5]
echo BR;



// Напишіть функцію для перевірки того, чи є слово паліндромом.

function isPalindrome(string $word): bool {
    $word = mb_strtolower($word);
    $word = str_replace(' ', '', $word);

    return $word === reverseString($word);
}


echo 'word "ротор" палиндром ? - ';
var_dump(isPalindrome('ротор'));
echo BR;
echo 'word "test" палиндром ? - ';
var_dump(isPalindrome('test'));
echo BR;


// Створіть функцію, яка повертає масив, який складається з парних чисел від 1 до 50.

function getEvenNumbers(): array {
    $evenNumbers = [];
    for ($i = 2; $i <= 50; $i += 2) {
        $evenNumbers[] = $i;
    }

    return $evenNumbers;
}

print_r(getEvenNumbers());
echo BR;

// Напишіть функцію для знаходження найменшого та найбільшого значення в масиві чисел.

function findMinMax(array $numbers): array {
    $min = min($numbers) ?? null; 
    $max = max($numbers) ?? null;

    return ['min' => $min, 'max' => $max];
}

$result = findMinMax([3, 1, 9, 7, 4, -2, 10]); //  Array ( [min] => -2 [max] => 10 )
 
echo "Найменше та Найбільше значення : " . print_r($result, true);
echo BR;

// Створіть функцію, яка приймає асоціативний масив і повертає новий масив зі значеннями, відсортованими за алфавітом за ключами.
function sortArrayByKeys(array $assocArray): array {
    ksort($assocArray); 

    return $assocArray;
}

// Приклад використання
$originalArray = [
    'banana' => 2,
    'apple' => 5,
    'cherry' => 3,
    'date' => 1
];

print_r(sortArrayByKeys($originalArray));
echo BR;


// Напишіть функцію для обчислення факторіалу числа.

function factorial(int $n, array &$memo = []): int {
    if (isset($memo[$n])) {
        return $memo[$n];
    }
    
    if ($n === 0 || $n === 1) {
        return 1;
    }

    $memo[$n] = $n * factorial($n - 1, $memo);
    
    
    return $memo[$n];
}

$n = 5;
echo "факторіал числа {$n} це " . factorial($n);

echo BR;
function isPrime(int $number): bool {
    if ($number < 2) {
        return false;
    }

    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true; 
}

function findPrimesInRange(int $start, int $end): array {
    $primes = [];

    for ($i = $start; $i <= $end; $i++) {
        if (isPrime($i)) {
            $primes[] = $i;
        }
    }

    return $primes;
}

$start = 10;
$end = 50;
$primes = findPrimesInRange($start, $end);

echo "Прості числа в діапазоні від $start до $end: " . implode(', ', $primes);

echo BR;
// Напишіть функцію для об'єднання двох масивів без повторень.

function mergeArraysUnique(array $array1, array $array2): array {
    $mergedArray = array_merge($array1, $array2);
    $uniqueArray = removeDuplicates($mergedArray);
    
    return $uniqueArray;
}

// Приклад використання
$array1 = [1, 2, 3, 4];
$array2 = [3, 4, 5, 6];

$result = mergeArraysUnique($array1, $array2);

print_r($result); // Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 )

echo BR;
// Створіть функцію, яка приймає рядок та повертає новий рядок, в якому кожне слово починається з великої літери.

function capitalizeWords(string $str): string {
    $isAscii = preg_match('/^[\x00-\x7F]*$/', $str) === 1;

    return $isAscii ? ucwords($str): mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
}

echo capitalizeWords("hello, how are you?") . " "; // "Hello, How Are You?"
echo capitalizeWords("привіт, як справи?"); // "Привіт, Як Справи?"
echo BR;

// Напишіть функцію для генерації випадкового пароля заданої довжини.

function generateRandomPassword(int $length = 8): string {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    
    $password = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $password;
}

echo 'рандомний пароль з 12 симоволів:' . generateRandomPassword(12); 
echo BR;

// Створіть функцію для знаходження суми елементів на головній діагоналі квадратної матриці.

function sumMainDiagonal(array $matrix): float {
    $sum = 0;
    $size = count($matrix);

    for ($i = 0; $i < $size; $i++) {
        $sum += $matrix[$i][$i];
    }

    return $sum;
}

$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

echo "Сума елементів на головній діагоналі: " . sumMainDiagonal($matrix); // 15
echo BR;

// Напишіть функцію для видалення всіх HTML-тегів з рядка.

function removeHtmlTags(string $str): string {
    return strip_tags($str);
}

$inputString = "<h1>Привіт, <b>світ</b>!</h1>";
$cleanString = removeHtmlTags($inputString);

echo $cleanString; // "Привіт, світ!"
echo BR;

// Створіть функцію для реверсу асоціативного масиву (замініть ключі на значення і навпаки).

function reverseAssociativeArray(array $assocArray): array {
    // Використовуємо array_flip для заміни ключів і значень
    return array_flip($assocArray);
}

$originalArray = [
    'apple' => 'green',
    'banana' => 'yellow',
    'cherry' => 'red'
];

$reversedArray = reverseAssociativeArray($originalArray);

print_r($reversedArray); // Array ( [green] => apple [yellow] => banana [red] => cherry )
echo BR;

// Напишіть функцію для перетворення рядка у крапковану нотацію (camelCase).

function toCamelCase(string $str): string {
    $str = str_replace(['-', '_'], ' ', $str);

    $capitalizedWords = capitalizeWords($str);
    
    return lcfirst(str_replace(' ', '', $capitalizedWords));
}

// Приклад використання
$inputString = "hello-world_example string";
$result = toCamelCase($inputString);

echo "'{$inputString}' in camelCase: " . $result; // helloWorldExampleString
echo BR;

// Створіть функцію, яка перевіряє, чи є число ступенем двійки.

function isPowerOfTwo(int $n): bool {
    if ($n <= 0) {
        return false;
    }

    // Обчислюємо логарифм числа по основі 2 та перевіряємо, чи є результат цілим числом
    $logResult = log($n, 2);

    // теоритично результатом обчислення щось накшталт log(16, 2) може бути щось на зразок 4.000000000000001, а не строго 4. 
    // Якщо ми використаємо строге порівняння (===), воно не пройде через цю незначну похибку.
    return floor($logResult) == $logResult;
}

$number = 16;
if (isPowerOfTwo($number)) {
    echo "$number є ступенем двійки.";
} else {
    echo "$number не є ступенем двійки.";
}

echo BR;

// Напишіть функцію для сортування масиву об'єктів за значенням конкретного ключа

function sortByKey(array $array, string $key): array {
    usort($array, fn($a, $b) => $a->$key <=> $b->$key);

    return $array;
}

class Person {
    public $name;
    public $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
}

$people = [
    new Person('John', 25),
    new Person('Alice', 30),
    new Person('Bob', 22)
];

// Сортуємо масив об'єктів за значенням ключа 'age'
$sortedByAge = sortByKey($people, 'age');

// Виведення результату: Bob - 22 John - 25 Alice - 30
foreach ($sortedByAge as $person) {
    echo $person->name . " - " . $person->age . "; ";
}

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
    </ul>
  </section>
</body>
</html>