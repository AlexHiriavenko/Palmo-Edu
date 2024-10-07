<?php
session_start();

function clearSession()
{
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

$timestampMarchDay = mktime(13, 12, 59, 3, 15, 2000);
$seconds_passed = time() - $timestampMarchDay;
echo "Кількість секунд з 13:12:59 15 березня 2000 року до теперішнього часу: " . $seconds_passed . " секунд";
echo BR;

$timestampСertainTime = mktime(7, 23, 48, date("m"), date("d"), date("Y"));
$hours_passed = (time() - $timestampСertainTime) / 3600;
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

$timestampCertainYear = mktime(0, 0, 0, 6, 6, 2006);
echo "06.06.2006 was " . $week[date("w", $timestampCertainYear)];
echo BR;

$timestamp_birthday = mktime(0, 0, 0, 03, 17, 1985);
echo "My birthday was on: " . $week[date("w", $timestamp_birthday)];
echo BR;

$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
echo "Now: " . $months[date("n") - 1];
echo BR;

echo "Кількість днів у поточному місяці: " . date("t");


// Зробіть поле введення, в яке користувач вводить рік (4 цифри), а скрипт визначає чи високосний рік.
if (isset($_POST['year'])) {
  $year = (int)htmlspecialchars($_POST['year']);

  if (($year % 4 === 0 && $year % 100 !== 0) || $year % 400 === 0) {
    $_SESSION['typeYearResult'] = "$year є високосним роком.";
  } else {
    $_SESSION['typeYearResult'] = "$year не є високосним роком.";
  }
  $_SESSION['savedYear'] = $year;
}

$savedYear = $_SESSION['savedYear'] ?? '';
$typeYearResult = $_SESSION['typeYearResult'] ?? '';

// Зробіть форму, яка запитує дату у форматі '31.12.2025'. За допомогою mktime та explode переведіть цю дату у формат timestamp. 
// Дізнайтесь день тижня (словом) за введену дату.

if (isset($_POST['date'])) {
  $date = htmlspecialchars($_POST['date']);
  $date_parts = explode('.', $date);

  if (count($date_parts) === 3) {
    list($day, $month, $year) = $date_parts;
    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    $_SESSION['weekDayResult'] = "День тижня: " . $week[date("w", $timestamp)];
    $_SESSION['savedDate'] = $date;
  }
}

$savedDate = $_SESSION['savedDate'] ?? '';
$weekDayResult = $_SESSION['weekDayResult'] ?? '';


// Зробіть форму, яка запитує дату у форматі '2025-12-31'. За допомогою mktime та explode переведіть цю дату у формат timestamp. 
// Дізнайтесь місяць (словом) за введену дату.

if (isset($_POST['iso_date'])) {
  $iso_date = htmlspecialchars($_POST['iso_date']);
  $date_parts = explode('-', $iso_date);

  if (count($date_parts) === 3) {
    list($year, $month, $day) = $date_parts;
    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    $monthResult = "Місяць: " . $months[date("n", $timestamp) - 1];
    $_SESSION['monthResult'] = $monthResult;
    $_SESSION['savedIsoDate'] = $iso_date;
  }
}

$savedIsoDate = $_SESSION['savedIsoDate'] ?? '';
$monthResult = $_SESSION['monthResult'] ?? '';

// Порівняння дат
// Зробіть форму, яка запитує дві дати у форматі '2025-12-31'. 
// Першу дату запишіть у змінну $date1, а другу в $date2. 
// Порівняйте, яка із введених дат більше. Виведіть її на екран.

if (isset($_POST['date1']) && isset($_POST['date2'])) {
  // Получаем и обрабатываем введённые данные
  $date1 = htmlspecialchars($_POST['date1']);
  $date2 = htmlspecialchars($_POST['date2']);

  $timestampFirst = strtotime($date1);
  $timestampSecond = strtotime($date2);

  // Сравниваем даты и сохраняем результат в сессию
  if ($timestampFirst && $timestampSecond) {
    if ($timestampFirst > $timestampSecond) {
      $_SESSION['comparisonResult'] = "Дата $date1 пізніше ніж $date2.";
    } elseif ($timestampFirst < $timestampSecond) {
      $_SESSION['comparisonResult'] = "Дата $date2 пізніше ніж $date1.";
    } else {
      $_SESSION['comparisonResult'] = "Обидві дати рівні.";
    }

    $_SESSION['date1Value'] = $date1;
    $_SESSION['date2Value'] = $date2;
  } else {
    $_SESSION['comparisonResult'] = "Некоректний формат дати.";
  }
}

$comparisonResult = $_SESSION['comparisonResult'] ?? '';
$date1Value = $_SESSION['date1Value'] ?? '';
$date2Value = $_SESSION['date2Value'] ?? '';

echo BR;

// Дана дата '2025-12-31'. За допомогою функції strtotime та date перетворіть її на формат '31-12-2025'.

$dateUS = '2025-12-31';
$timestamp = strtotime($dateUS);
$dateEU = date('d-m-Y', $timestamp); // 31-12-2025
echo 'дата в формате EU: ' . $dateEU;
echo BR;

// Зробіть форму, яка запитує дату-час у форматі '2025-12-31T12:13:59'. 
// За допомогою функції strtotime та функції date перетворіть її на формат '12:13:59 31.12.2025'.

if (isset($_POST['datetime'])) {
  $datetime = htmlspecialchars($_POST['datetime']);

  $timestamp = strtotime($datetime);

  if ($timestamp !== false) {
    $formattedDateTime = date('H:i:s d.m.Y', $timestamp);

    $_SESSION['savedDateTime'] = $datetime;
    $_SESSION['formattedResult'] = $formattedDateTime;
  }
}

$savedDateTime = $_SESSION['savedDateTime'] ?? '';
$formattedResult = $_SESSION['formattedResult'] ?? '';

// date_create, date_modify, date_format.
// У змінній $date лежить дата у форматі '2025-12-31'. Додайте до цієї дати 2 дні, 1 місяць та 3 дні, 1 рік. Заберіть від цієї дати 3 дні.

$operationDate = date_create('2025-12-31');

date_modify($operationDate, '+2 days');
date_modify($operationDate, '+1 month +3 days');
date_modify($operationDate, '+1 year');
date_modify($operationDate, '-3 days');

$operationDate = date_format($operationDate, 'Y-m-d');

echo 'Змінена дата: ' . $operationDate;
echo BR;


// Дізнайтеся, скільки днів залишилося до Нового Року. Скрипт має працювати у будь-якому році.

$currentDate = new DateTime();

$nextYear = (int)$currentDate->format('Y') + 1;
$newYearDate = new DateTime("$nextYear-01-01");
$interval = $currentDate->diff($newYearDate);

echo 'До Нового Року залишилось: ' . $interval->days . ' днів';
echo BR;

// Зробіть форму, де користувач вводить рік. Знайдіть усі п'ятниці 13-те цього року. Результат виведіть у вигляді масиву дат.

if (isset($_POST['check_friday_13'])) {
  $year = (int)htmlspecialchars($_POST['friday_year']);

  $fridayThirteenth = [];

  for ($month = 1; $month <= 12; $month++) {
    $date = new DateTime("$year-$month-13");
    // если пятница
    if ($date->format('N') == 5) {
      $fridayThirteenth[] = $date->format('Y-m-d');
    }
  }

  $_SESSION['friday13'] = $fridayThirteenth;
  $_SESSION['savedFridayYear'] = $year;
}

$savedFridayYear = $_SESSION['savedFridayYear'] ?? '';
$fridayThirteenth = $_SESSION['friday13'] ?? [];

//  Дізнайтеся, який день тижня був 100 днів тому.

$currentDate = new DateTime();
$daysAgo100 =
  $currentDate->modify('-100 days')->format('l');
echo "100 днів тому був: " . $daysAgo100;
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
    <!-- Высокосный год ? -->
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
        value=<?php echo $savedYear; ?>>
      <input type="submit" value="Перевірити">
    </form>
    <p>Відповідь: <?php echo $typeYearResult; ?></p>
    <!-- Ден Недели -->
    <form method="post">
      Введіть дату:
      <input
        type="text"
        name="date"
        required
        pattern="^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[0-2])\.(\d{4})$"
        placeholder="31.12.2025"
        title="формат: 31.12.2025"
        value=<?php echo $savedDate; ?>>
      <input type="submit" value="Дізнатись день тижня">
    </form>
    <p>Відповідь: <?php echo $weekDayResult; ?></p>
    <!-- Месяц -->
    <form method="post">
      Введіть дату (формат: 2025-12-31):
      <input
        type="text"
        name="iso_date"
        required
        pattern="\d{4}-\d{2}-\d{2}"
        placeholder="2025-12-31"
        title="формат: 2025-12-31"
        value=<?php echo $savedIsoDate; ?>>
      <input type="submit" value="Дізнатись місяць">
    </form>
    <p>Відповідь: <?php echo $monthResult; ?></p>
    <!-- Сравнение Дат -->
    <form method="post">
      <label for="date1">Введіть першу дату (формат: 2025-12-31):</label>
      <input
        type="text"
        id="date1"
        name="date1"
        required
        pattern="\d{4}-\d{2}-\d{2}"
        placeholder="2025-12-31"
        title="формат: 2025-12-31"
        value=<?php echo $date1Value; ?>>
      <br>
      <br>
      <label for="date2">Введіть другу дату (формат: 2025-12-31):</label>
      <input
        type="text"
        id="date2"
        name="date2"
        required
        pattern="\d{4}-\d{2}-\d{2}"
        placeholder="2025-12-31"
        title="формат: 2025-12-31"
        value=<?php echo $date2Value; ?>>
      <br>
      <br>
      <input type="submit" value="Порівняти дати">
    </form>
    <p>Результат порівняння дат:
      <?php echo $comparisonResult;
      echo BR; ?>
    </p>
    <!-- Переделать Формат Даты -->
    <form method="post">
      <label for="datetime">Введіть дату-час (формат: 2025-12-31T12:13:59):</label>
      <input
        type="text"
        id="datetime"
        name="datetime"
        required
        pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}"
        placeholder="2025-12-31T12:13:59"
        title="формат: 2025-12-31T12:13:59"
        value="<?php echo htmlspecialchars($savedDateTime); ?>">
      <br>
      <br>
      <input type="submit" value="Перетворити">
    </form>
    <p>Відповідь:
      <?php echo htmlspecialchars($formattedResult);
      echo BR;
      ?>
    </p>
    <!-- Найти пятницы 13е -->
    <form method="post">
      <input type="hidden" name="check_friday_13" value="1">
      <label for="friday_year">Введіть рік (для пошуку п'ятниць 13-го):</label>
      <input
        type="text"
        id="friday_year"
        name="friday_year"
        required
        minlength="4"
        maxlength="4"
        pattern="\d{4}"
        placeholder="2024"
        value="<?php echo htmlspecialchars($savedFridayYear); ?>">
      <br>
      <br>
      <input type="submit" value="Знайти п'ятниці 13-го">
    </form>
    <p>П'ятниці 13-го у вибраному році: <?php print_r($fridayThirteenth); ?></p>

    <!-- Очистить Сессию -->
    <form method="post">
      <input type="hidden" name="clear_session" value="1">
      <input type="submit" value="Очистити сесію" class="clear">
    </form>
  </section>

  <!-- Навигация -->
  <section>
    <ul>
      <li><a href="./files-system.php">to HW-3 FileSystem</a></li>
      <li><a href="../index.php">Back to Main</a></li>
    </ul>
  </section>
</body>

</html>