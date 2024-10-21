<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Database/fillBaseFirstTime.php';

use Palmo\Database\Db;
use Palmo\Models\SportEventModel;

$db = new Db();

// Заполняем базу данных, если она пуста
fillBaseFirstTime(new SportEventModel($db), $db);

// Получаем выбранную категорию
$category = $_GET['category'] ?? 'all';

$sportEventModel = new SportEventModel($db);

// Если выбрана категория, фильтруем события
if ($category !== 'all') {
    $events = $sportEventModel->getFilteredEvents(['category' => $category]);
} else {
    // Если категория "all", получаем все события
    $events = $sportEventModel->getAllEvents();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./public/imgs/football.ico">
    <link rel="stylesheet" href="./public/styles/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/styles.css">
    <title>Sports Events</title>
</head>

<body class="bg-gray-900 text-white">
    <?php include './views/app_header.php'; ?>

    <main class="app-main views home p-4">
        <div class="mb-6 mx-auto w-64">
            <form action="" method="GET">
                <label for="category" class="text-lg text-gray-200 font-semibold">Фильтровать по:</label>
                <select name="category" id="category" onchange="this.form.submit()" class="text-gray-800 text-center">
                    <option value="all" <?= !isset($_GET['category']) || $_GET['category'] === 'all' ? 'selected' : '' ?>>All</option>
                    <option value="soccer" <?= isset($_GET['category']) && $_GET['category'] === 'soccer' ? 'selected' : '' ?>>Soccer</option>
                    <option value="volleyball" <?= isset($_GET['category']) && $_GET['category'] === 'volleyball' ? 'selected' : '' ?>>Volleyball</option>
                    <option value="basketball" <?= isset($_GET['category']) && $_GET['category'] === 'basketball' ? 'selected' : '' ?>>Basketball</option>
                </select>
            </form>
        </div>
        <div class="container mx-auto">
            <?php
            if (!empty($events)) {
                echo "<div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6'>";
                foreach ($events as $event) {
                    // Формируем данные карточки
                    $eventData = [
                        'name' => $event['name'] ?? 'Неизвестное событие',
                        'category' => $event['category'] ?? 'Неизвестная категория',
                        'location' => $event['location'] ?? 'Неизвестное место',
                        'dateTime' => $event['dateTime'],
                        'price' => $event['price'] !== null ? $event['price'] : 0
                    ];

                    // Отображаем карточку
                    echo "
                <div class='bg-gray-800 bg-opacity-80 rounded-lg shadow-lg p-6'>
                    <h2 class='text-xl text-gray-200 font-bold mb-2'>" . htmlspecialchars($eventData['name']) . "</h2>
                    <p class='text-sm text-gray-200'>Категория: " . htmlspecialchars($eventData['category']) . "</p>
                    <p class='text-sm text-gray-200'>Место: " . htmlspecialchars($eventData['location']) . "</p>
                    <p class='text-sm text-gray-200'>Дата: " . htmlspecialchars($eventData['dateTime']) . "</p>
                    <p class='text-sm text-gray-200'>Цена: $" . htmlspecialchars($eventData['price']) . ".</p>
                    <button class='mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600'>
                        Узнать больше
                    </button>
                </div>";
                }
                echo "</div>";
            } else {
                echo "<p class='text-center'>Список событий пуст.</p>";
            }
            ?>
        </div>
    </main>
</body>

</html>