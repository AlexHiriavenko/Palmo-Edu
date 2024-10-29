<?php
require '../vendor/autoload.php';

use Palmo\Database\Db;
use Palmo\Models\SportEventModel;
use Palmo\Models\OccupiedSeatsModel;
use Palmo\Service\AuthService;

$db = new Db();
$authService = new AuthService($db);
$sportEventModel = new SportEventModel($db);
$occupiedSeatsModel = new OccupiedSeatsModel($db);

$authService->authenticateUser();
$isLoggedIn = isset($_SESSION['userId']);

// Получаем ID события из параметров URL
$eventId = (int)($_GET['id']);

// Получаем данные события по его ID
$event = $sportEventModel->readById('sportEvents', $eventId);

if (empty($event)) {
    header('Location: /404.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isLoggedIn) {
     $selectedSeats = $_POST['selectedSeats'] ?? [];
     print_r($selectedSeats);
}

// Получаем номера занятых мест для события и для текущего пользователя
$userOccupiedSeatsNumbers = $isLoggedIn ? $occupiedSeatsModel->getEventOccupiedSeatsByUser($eventId, $_SESSION['userId']) : [];
$occupiedSeatsNumbers = $occupiedSeatsModel->getEventOccupiedSeats($eventId);
$occupiedSeatsNumbers = array_diff($occupiedSeatsNumbers, $userOccupiedSeatsNumbers);

const TOTAL_SEATS = 50;
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
                <form 
                    method="post" 
                    action="event-details.php?id=<?= $eventId ?>"
                    class="<?= !$isLoggedIn ? 'pointer-events-none' : '' ?>"
                    >
                    <div class="grid grid-cols-10 gap-3 mt-4 max-w-[600px] mx-auto bg-black bg-opacity-35 p-4">
                        <?php for ($seatNumber = 1; $seatNumber <= TOTAL_SEATS; $seatNumber++): ?>
                            <?php
                                $isUserOccupied = in_array($seatNumber, $userOccupiedSeatsNumbers);
                                $isOccupied = in_array($seatNumber, $occupiedSeatsNumbers);
                            ?>
                        <div class="flex items-center justify-center">
                            <label class="flex items-center relative <?= !$isOccupied ? 'cursor-pointer' : '' ?>">
                                <input
                                    name="selectedSeats[]"
                                    id="<?= $seatNumber ?>"
                                    value="<?= $seatNumber ?>"
                                    <?= $isUserOccupied ? 'checked' : '' ?>
                                    <?= $isOccupied ? 'disabled' : '' ?>
                                    type="checkbox" 
                                    class="bg-white peer h-9 w-9 transition-all appearance-none rounded shadow hover:shadow-md border checked:bg-green-500 checked:border-green-500 
                                    <?= $isOccupied ? 'bg-amber-600 border-amber-600' : 'bg-gray-300 cursor-pointer' ?> "
                                >
                                <span class="absolute <?= $isOccupied ? 'text-white' : 'text-black' ?>
                                peer-checked:text-white top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                    <?= $seatNumber ?>
                                </span>
                            </label>
                        </div>
                        <?php endfor; ?>
                    </div>
                    <? if ($isLoggedIn): ?>
                        <button type="submit" id="submitBooking">Подтвердить бронирование</button>
                    <? endif; ?>
                </form>
            </div>

            <a href="index.php" class='text-2xl w-60 mt-8 mx-auto block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-center'>
                Вернуться на Главную страницу
            </a>
        </div>
    </main>
</body>

</html>
