<?php

const BR = '<br>';

// Створіть файл 'test.txt' , запишіть у нього рядок 'Hello Palmo'.

$test_txt = './files/test.txt';
$test_txt_opened = fopen($test_txt, 'w');

if ($test_txt_opened) {
  fwrite($test_txt_opened, 'Hello Palmo');
  fclose($test_txt_opened);
} else {
  echo "Не удалось создать файл для записи.";
}
// Відобразіть вміст файлу на сторінці


$test_txt_size = filesize($test_txt);
$test_txt_read = fopen($test_txt, "r");

if ($test_txt_read) {
  $content = fread($test_txt_read, $test_txt_size);
  fclose($test_txt_read);
  echo "Содержимое файла test.txt: {$content}";
  echo BR;
} else {
  echo "Не удалось открыть файл для чтения.";
}

// Відобразіть розмір файлу на сторінці (У байтах, мегабайтах, гігабайтах)

$test_txt_MB = $test_txt_size / 1024 / 1024;
$test_txt_GB = $test_txt_MB / 1024;

echo "Размер файла test.txt {$test_txt_size} B или {$test_txt_MB} MB или {$test_txt_GB} GB";
echo BR;

// Створіть файл 'test2.txt'

$test2_txt = './files/test2.txt';
$test2_txt_opened = fopen($test2_txt, 'w');
if ($test2_txt_opened) {
  fclose($test2_txt_opened);
}

// Видаліть 'test2.txt'

if (file_exists($test2_txt)) {
  unlink($test2_txt);
} else {
  echo "Файл '$test2_txt' не существует.";
}

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