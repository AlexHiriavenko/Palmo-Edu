<?php

const BR = '<br>';

function topThreeWords($text) {
    $occurrences = [];
    $word = "";

    // Проход по каждому символу строки
    for ($i = 0; $i < strlen($text); $i++) {
        $char = strtolower($text[$i]);

        // Если это буква или апостроф, добавляем в слово
        if (preg_match("/[a-z']/i", $char)) {
            $word .= $char;
        } elseif ($word && $word !== "'") {
            // Если встречаем разделитель, обновляем счётчик слова
            $occurrences[$word] = ($occurrences[$word] ?? 0) + 1;
            $word = ""; // Обнуляем текущее слово
        }
    }

    // Добавляем последнее слово в счётчик вхождений, если оно есть
    if ($word && $word !== "'") {
        $occurrences[$word] = ($occurrences[$word] ?? 0) + 1;
    }

    // Массив для хранения топ-3 слов
    $topWords = [];

    // Проход по объекту occurrences
    foreach ($occurrences as $key => $value) {
        // Добавляем слово в массив топ-3, если он еще не полный
        if (count($topWords) < 3) {
            $topWords[] = [$key, $value];
            usort($topWords, fn($a, $b) => $b[1] - $a[1]); // Сортируем только топ-3 с помощью стрелочной функции
        } else {
            // Если новое слово имеет больше вхождений, чем наименьшее в топ-3, заменяем его
            if ($value > $topWords[2][1]) {
                $topWords[2] = [$key, $value];
                usort($topWords, fn($a, $b) => $b[1] - $a[1]); // Сортируем только топ-3 с помощью стрелочной функции
            }
        }
    }

    // Возвращаем только слова из topWords
    return array_map(fn($entry) => $entry[0], $topWords); // Стрелочная функция для map
}

// БЕЗ КРИТЕРИЕВ ОПТИМИЗАЦИИ:

function topThreeWordsSecond($text) {
    // Приводим текст к нижнему регистру и ищем все слова с помощью регулярного выражения
    preg_match_all("/([a-z]+'?[a-z']*)/i", strtolower($text), $matches);
    $words = $matches[0];

    // Если слов нет, возвращаем пустой массив
    if (empty($words)) {
        return [];
    }

    // Подсчёт количества каждого слова
    $wordCount = [];
    foreach ($words as $word) {
      $wordCount[$word] = ($wordCount[$word] ?? 0) + 1;
    }

    // Сортируем слова по количеству вхождений
    uksort($wordCount, fn($a, $b) => $wordCount[$b] - $wordCount[$a]);

    // Берём первые три слова
    return array_slice(array_keys($wordCount), 0, 3);
}



// Тесты

print_r(topThreeWords("a a a  b  c c  d d d d  e e e e e")); // [ 'e', 'd', 'a' ]
echo BR;
print_r(topThreeWords("a a a c b b")); // [ 'a', 'b', 'c' ]
echo BR;
print_r(topThreeWords("e e e e DDD ddd DdD: ddd ddd aa aA Aa, bb cc cC e e e")); // [ 'e', 'ddd', 'aa' ]
echo BR;
print_r(topThreeWords("  //wont won't won't ")); // [ 'won't', 'wont' ]
echo BR;
print_r(topThreeWords("  , e   .. ")); // [ 'e' ]
echo BR;
print_r(topThreeWords("  ...  ")); // []
echo BR;
print_r(topThreeWords("  '  ")); // []
echo BR;
print_r(topThreeWords(
    "In a village of La Mancha, the name of which I have no desire to call to
    mind, there lived not long since one of those gentlemen that keep a lance
    in the lance-rack, an old buckler, a lean hack, and a greyhound for
    coursing. An olla of rather more beef than mutton, a salad on most
    nights, scraps on Saturdays, lentils on Fridays, and a pigeon or so extra
    on Sundays, made away with three-quarters of his income."
)); // [ 'a', 'of', 'on' ]
echo BR;

// Тесты topThreeWordsSecond
echo BR;
print_r(topThreeWordsSecond("a a a  b  c c  d d d d  e e e e e")); // [ 'e', 'd', 'a' ]
echo BR;
print_r(topThreeWordsSecond("a a a c b b")); // [ 'a', 'b', 'c' ]
echo BR;
print_r(topThreeWordsSecond("e e e e DDD ddd DdD: ddd ddd aa aA Aa, bb cc cC e e e")); // [ 'e', 'ddd', 'aa' ]
echo BR;
print_r(topThreeWordsSecond("  //wont won't won't ")); // [ 'won't', 'wont' ]
echo BR;
print_r(topThreeWordsSecond("  , e   .. ")); // [ 'e' ]
echo BR;
print_r(topThreeWordsSecond("  ...  ")); // []
echo BR;
print_r(topThreeWordsSecond("  '  ")); // []
echo BR;
print_r(topThreeWordsSecond(
    "In a village of La Mancha, the name of which I have no desire to call to
    mind, there lived not long since one of those gentlemen that keep a lance
    in the lance-rack, an old buckler, a lean hack, and a greyhound for
    coursing. An olla of rather more beef than mutton, a salad on most
    nights, scraps on Saturdays, lentils on Fridays, and a pigeon or so extra
    on Sundays, made away with three-quarters of his income."
)); // [ 'a', 'of', 'on' ]
echo BR;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles.css" rel="stylesheet">
  <title>most-frequently-used-words</title>

</head>

<body>
  <h1>most-frequently-used-words</h1>
  <section>
    <ul>
      <li><a href="../index.php">back to Main</a></li>
    </ul>
  </section>
</body>

</html>