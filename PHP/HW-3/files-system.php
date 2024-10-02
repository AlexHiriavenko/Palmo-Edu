<?php

const BR = '<br>';

// Створіть файл 'test.txt' , запишіть у нього рядок 'Hello Palmo'.

$test_txt = './test.txt';
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

// Створіть папку TestDir

$folderPath = './TestDir';
if (!file_exists($folderPath)) {
  mkdir($folderPath);
}

// Дано масив ['test1','test2','test3'], створіть у папці TestDir папки, назвами яких слугують рядки масиву 
// Створіть у кожній вкладеній у TestDir папці, файл Hello.txt, у кожен із них запишіть рядок "Hello world", 
// виведіть на екран вміст усіх файлів.

$dirsNames = ['test1','test2','test3'];

foreach($dirsNames as $dirName) {
  $currentFolderPath = "{$folderPath}/{$dirName}";
  $currentFilePath = "{$currentFolderPath}/Hello.txt";


  if (!file_exists($currentFolderPath)) {
    mkdir($currentFolderPath);
    file_put_contents($currentFilePath, 'Hello world');
  }

  if (file_exists($currentFilePath)) {
    echo "содержание файла {$currentFilePath}: " . file_get_contents($currentFilePath);
    echo BR;
  }
}

// Напишіть функцію, яка приймає назву файлу або папки і перевіряє, чи є передане значення файлом або папкою (повернути рядок)

function checkFileOrDirectory($path) {
    if (file_exists($path)) {
        if (is_dir($path)) {
            return "{$path} - це папка.";
        } elseif (is_file($path)) {
            return "{$path} - це файл.";
        } else {
            return "{$path} - це не файл і не папка.";
        }
    } else {
        return "Файл або папка не існує.";
    }
}

echo checkFileOrDirectory($folderPath);
echo BR;
echo checkFileOrDirectory("{$folderPath}/test1/Hello.txt");
echo BR;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles.css" rel="stylesheet">
  <title>php HW-3 FileSystem</title>

</head>

<body>
  <section>
    <ul>
      <li><a href="./dates.php">to HW-3 Dates</a></li>
      <li><a href="../index.php">Back to Main</a></li>
    </ul>
  </section>
</body>

</html>