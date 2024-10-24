<?php
require '../vendor/autoload.php';

use Palmo\Database\Db;
use Palmo\Models\SportEventModel;
use Palmo\Models\OccupiedSeatsModel;

$db = new Db();
$sportEventModel = new SportEventModel($db);
$occupiedSeatsModel = new OccupiedSeatsModel($db);

// Получаем ID события из параметров URL
$eventId = (int)($_GET['id']);

// Получаем данные события по его ID
$event = $sportEventModel->readById('sportEvents', $eventId);

if (empty($event)) {
    header('Location: /404.php');
    exit;
}

$occupiedSeats = $occupiedSeatsModel->getOccupiedSeatsByEventId($eventId);
$occupiedSeatsNumbers = array_column($occupiedSeats, 'seatNumber');

$totalSeats = 50;
$rows = 5;
$seatsPerRow = 10;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./public/imgs/football.ico">
    <link rel="stylesheet" href="./public/styles/reset.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/public/styles/styles.css">
    <title>Event Details</title>
</head>

<body class="bg-gray-900 text-white">
    <?php include '../views/app_header.php'; ?>

    <main class="app-main views home p-4">
        <div class="container mx-auto">
            <div class='bg-gray-800 bg-opacity-80 rounded-lg shadow-lg p-6 max-w-[600px] mx-auto'>
                <h2 class='text-2xl text-gray-200 font-bold mb-2 text-center'>
                    <?= htmlspecialchars($event['name'] ?? 'Неизвестное событие') ?>
                </h2>
                <p class='text-lg text-gray-200'>Категория: <?= htmlspecialchars($event['category'] ?? 'Неизвестная категория') ?></p>
                <p class='text-lg text-gray-200'>Место: <?= htmlspecialchars($event['location'] ?? 'Неизвестное место') ?></p>
                <p class='text-lg text-gray-200'>Дата: <?= htmlspecialchars($event['dateTime']) ?></p>
                <p class='text-lg text-gray-200'>Цена: $<?= htmlspecialchars($event['price'] !== null ? $event['price'] : 0) ?></p>
            </div>

            <div class="mt-6">
                <h2 class="text-2xl text-center font-bold text-shadow">Схема мест</h2>
                <div class="grid grid-cols-10 gap-2 mt-4 max-w-[700px] mx-auto bg-black bg-opacity-35 p-4">
                    <?php for ($seatNumber = 1; $seatNumber <= $totalSeats; $seatNumber++): ?>
                        <?php $isOccupied = in_array($seatNumber, $occupiedSeatsNumbers); ?>
                        <div class="flex items-center justify-center w-12 h-12 rounded-md
                            <?= $isOccupied ? 'bg-amber-600 text-white' : 'bg-gray-300 text-gray-800' ?>">
                            <?= $seatNumber ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Вернуться к списку событий -->
            <a href="index.php" class='text-2xl w-60 mt-8 mx-auto block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-center'>
                Вернуться на Главную страницу
            </a>
        </div>
    </main>
</body>

</html>