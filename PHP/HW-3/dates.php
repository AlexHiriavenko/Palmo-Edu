<?php
session_start();

function clearSession() {
    $_SESSION = [];
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}

if (isset($_POST['clear_session'])) {
    clearSession();  
}

const BR = '<br>';

// Timestamp: time та mktime. Використовуйте такі функції: time, mktime.
//  Виведіть поточний час у форматі timestamp.
//  Виведіть 1 березня 2025 року у форматі timestamp.
//  Виведіть 31 грудня поточного року у форматі timestamp. Скрипт повинен працювати незалежно від року, коли він запущений.
//  Знайдіть кількість секунд, що пройшли з 13:12:59 15 березня 2000 року до теперішнього часу.
//  Знайдіть кількість годин, що пройшли з 7:23:48 поточного дня до цього часу.

date_default_timezone_set('Europe/Kiev');

echo "Поточний час у форматі timestamp: " . time();
echo BR;

echo "1 березня 2025 року у форматі timestamp: " . mktime(0, 0, 0, 3, 1, 2025);
echo BR;

$current_year = date("Y");
echo "31 грудня поточного року у форматі timestamp: " . mktime(0, 0, 0, 12, 31, $current_year);
echo BR;

$timestamp_15_march_2000 = mktime(13, 12, 59, 3, 15, 2000);
$seconds_passed = time() - $timestamp_15_march_2000;
echo "Кількість секунд з 13:12:59 15 березня 2000 року до теперішнього часу: " . $seconds_passed . " секунд";
echo BR;

$timestamp_today_7_23_48 = mktime(7, 23, 48, date("m"), date("d"), date("Y"));
$hours_passed = (time() - $timestamp_today_7_23_48) / 3600;
echo "Кількість годин з 7:23:48 поточного дня до теперішнього часу: " . round($hours_passed, 2) . " годин";
echo BR;

// Функція date. 
// Виведіть на екран поточний рік, місяць, день, годину, хвилину, секунду.
// Виведіть поточну дату-час у форматах '2025-12-31', '31.12.2025', '31.12.13', '12:59:59'.
// За допомогою функцій mktime та date виведіть 12 лютого 2025 року у форматі '12.02.2025'.
// Створіть масив днів тижня $week. Виведіть на екран назву поточного дня тижня за допомогою масиву $week та функції date. 
// Дізнайтеся, який день тижня був 06.06.2006, у ваш день народження.
// Створіть масив місяців $month. Виведіть на екран назву поточного місяця за допомогою масиву $month та функції date.
// Знайдіть кількість днів у поточному місяці. Скрипт повинен працювати незалежно від місяця, коли він запущений.
// Зробіть поле введення, в яке користувач вводить рік (4 цифри), а скрипт визначає чи високосний рік.
// Зробіть форму, яка запитує дату у форматі '31.12.2025'. За допомогою mktime та explode переведіть цю дату у формат timestamp. 
// Дізнайтесь день тижня (словом) за введену дату.
// Зробіть форму, яка запитує дату у форматі '2025-12-31'. За допомогою mktime та explode переведіть цю дату у формат timestamp. 
// Дізнайтесь місяць (словом) за введену дату.

echo "Поточні дата та час: " . date("Y") . ' year_' 
                             . date("m") . ' month_'  
                             . date("d") . ' day_'  
                             . date("H") . ' hour_'  
                             . date("i") . ' minutes_'  
                             . date("s") . ' seconds';
echo BR;

echo date("Y-m-d");  // Формат '2025-12-31'
echo BR;
echo date("d.m.Y");  // Формат '31.12.2025'
echo BR;
echo date("d.m.y");  // Формат '31.12.13'
echo BR;
echo date("H:i:s");  // Формат '12:59:59'
echo BR;

$timestamp = mktime(0, 0, 0, 2, 12, 2025);
echo date("d.m.Y", $timestamp);
echo BR;

$week = ['sunday', 'monday', 'tuesday', 'wednesday', 'thuгsday', 'friday', 'saturday'];
echo "Today is: " . $week[date("w")];
echo BR;

$timestamp_2006 = mktime(0, 0, 0, 6, 6, 2006);
echo "06.06.2006 was " . $week[date("w", $timestamp_2006)];
echo BR;

$timestamp_birthday = mktime(0, 0, 0, 03, 17, 1985);
echo "My birthday was on: " . $week[date("w", $timestamp_birthday)];
echo BR;

$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
echo "Now: " . $months[date("n") - 1];
echo BR;

echo "Кількість днів у поточному місяці: " . date("t");
echo BR;

if (isset($_POST['year'])) {
    $year = (int)htmlspecialchars($_POST['year']);
    
    if (($year % 4 === 0 && $year % 100 !== 0) || $year % 400 === 0) {
        $_SESSION['typeYearResult'] = "$year є високосним роком.";
    } else {
        $_SESSION['typeYearResult'] = "$year не є високосним роком.";
    }
}

if (isset($_POST['date'])) {
    $date = htmlspecialchars($_POST['date']);
    $date_parts = explode('.', $date);

    if (count($date_parts) === 3) {
        list($day, $month, $year) = $date_parts;
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        $_SESSION['weekDayResult'] = "День тижня: " . $week[date("w", $timestamp)];
    }
}

if (isset($_POST['iso_date'])) {
    $iso_date = $_POST['iso_date']; // Получаем введённую дату
    $date_parts = explode('-', $iso_date); // Разбиваем дату на год, месяц и день

    if (count($date_parts) === 3) {
        list($year, $month, $day) = $date_parts; // Присваиваем значения
        $timestamp = mktime(0, 0, 0, $month, $day, $year); // Создаём timestamp
        $monthResult = "Місяць: " . $months[date("n", $timestamp) - 1]; // Получаем название месяца
        $_SESSION['monthResult'] = $monthResult; // Сохраняем результат в сессии
    }
}


$typeYearResult = $_SESSION['typeYearResult'] ?? '';
$weekDayResult = $_SESSION['weekDayResult'] ?? '';
$monthResult = $_SESSION['monthResult'] ?? '';

echo BR;


echo BR;


echo BR;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../styles.css" rel="stylesheet">
  <title>php HW-3 Dates</title>

</head>

<body>
  <section>
    <form method="post">
        <label for="year">Введіть рік:</label>
        <input 
          type="text" 
          id="year" 
          name="year" 
          required 
          minlength="4" 
          maxlength="4" 
          pattern="\d{4}"
          placeholder="2024" 
        >
        <input type="submit" value="Перевірити">
    </form>
    <p>Відповідь: <?php echo $typeYearResult; ?></p>
    <form method="post">
      Введіть дату: 
      <input 
          type="text" 
          name="date" 
          required 
          pattern="^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[0-2])\.(\d{4})$" 
          placeholder="31.12.2025" 
          title="формат: 31.12.2025"
      >
      <input type="submit" value="Дізнатись день тижня">
    </form>
    <p>Відповідь: <?php echo $weekDayResult; ?></p>
    <form method="post">
      Введіть дату (формат: 2025-12-31): 
      <input 
          type="text" 
          name="iso_date" 
          required 
          pattern="\d{4}-\d{2}-\d{2}" 
          placeholder="2025-12-31" 
          title="формат: 2025-12-31"
      >
      <input type="submit" value="Дізнатись місяць">
    </form>
    <p>Відповідь: <?php echo $monthResult; ?></p>
    <form method="post">
      <input type="hidden" name="clear_session" value="1">
      <input type="submit" value="Очистити сесію">
    </form>
  </section>
  <section>
    <ul>
      <li><a href="./files-system.php">to HW-3 FileSystem</a></li>
      <li><a href="../index.php">Back to Main</a></li>
    </ul>
  </section>
</body>

</html>