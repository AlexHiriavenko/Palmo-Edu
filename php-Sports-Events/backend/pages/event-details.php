<?php
require '../vendor/autoload.php';

use Palmo\Database\Db;
use Palmo\Repository\EventRepository;
use Palmo\Repository\BookingRepository;
use Palmo\Service\AuthService;

$db = new Db();
$authService = new AuthService($db);
$eventRepository = new EventRepository($db);
$bookingRepository = new BookingRepository($db);

$authService->authenticateUser();
$isLoggedIn = isset($_SESSION['userId']);
$eventId = (int)($_GET['id']);
$userId = $_SESSION['userId'];

// Получаем данные события по его ID
$event = $eventRepository->getEventByID($eventId);

if (empty($event)) {
    header('Location: /404.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isLoggedIn) {

    $action = $_POST['action'] ?? '';
    $userOccupiedSeats = $bookingRepository->getUserSeats($eventId, $userId) ?? [];
    $bookingRepository->removeUserSeats($eventId, $userId, $userOccupiedSeats);

    if ($action === 'cancel') {
        $bookingRepository->removeFromBookedEvents($userId, $eventId);
    }

    if ($action === 'book') {
        $selectedSeats = $_POST['selectedSeats'] ?? [];
        $bookingRepository->addUserSeats($eventId, $userId, $selectedSeats);
        $bookingRepository->addToBookedEvents($userId, $eventId);
    }
}

// Получаем номера занятых мест для события и для текущего пользователя
$userOccupiedSeats = $isLoggedIn ? $bookingRepository->getUserSeats($eventId, $userId) : [];
$eventOccupiedSeats = $eventRepository->getEventOccupiedSeats($eventId);
$occupiedSeats = array_diff($eventOccupiedSeats, $userOccupiedSeats);

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
                    <?= $event->getName() ?? 'Неизвестное событие' ?>
                </h2>
                <p class='text-lg text-gray-200'>Категория: <?= $event->getCategory() ?? 'Неизвестная категория' ?></p>
                <p class='text-lg text-gray-200'>Место: <?= $event->getLocation() ?? 'Неизвестное место' ?></p>
                <p class='text-lg text-gray-200'>Дата: <?= $event->getDateTime()->format('Y-m-d H:i') ?></p>
                <p class='text-lg text-gray-200'>Цена: $<?= $event->getPrice() ?? 0 ?></p>
            </div>

            <div class="mt-6">
                <h2 class="text-2xl text-center font-bold text-shadow">Схема мест</h2>
                <form
                    method="post"
                    action="event-details.php?id=<?= $eventId ?>"
                    class="<?= !$isLoggedIn ? 'pointer-events-none' : '' ?>">
                    <div class="grid grid-cols-10 gap-3 mt-4 max-w-[600px] mx-auto bg-black bg-opacity-35 p-4">
                        <?php for ($seatNumber = 1; $seatNumber <= TOTAL_SEATS; $seatNumber++): ?>
                            <?php
                            $isUserOccupied = in_array($seatNumber, $userOccupiedSeats);
                            $isOccupied = in_array($seatNumber, $occupiedSeats);
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
                                    <?= $isOccupied ? 'bg-amber-600 border-amber-600' : 'bg-gray-300 cursor-pointer' ?> ">
                                    <span class="absolute <?= $isOccupied ? 'text-white' : 'text-black' ?>
                                peer-checked:text-white top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                        <?= $seatNumber ?>
                                    </span>
                                </label>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <? if ($isLoggedIn): ?>
                        <div class="flex justify-center gap-4">
                            <button
                                type="submit"
                                id="submitBooking"
                                name="action"
                                value="book"
                                class="bg-blue-500 block hover:bg-blue-700 text-white font-bold py-2 px-4 my-4 rounded">
                                Подтвердить бронирование
                            </button>
                            <button
                                type="submit"
                                id="cancelBooking"
                                name="action"
                                value="cancel"
                                class="bg-blue-500 block hover:bg-blue-700 text-white font-bold py-2 px-4 my-4 rounded">
                                Оменить бронирование
                            </button>
                        </div>

                    <? endif; ?>
                </form>
            </div>

            <a href="index.php" class='text-2xl w-60 mt-8 mx-auto block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-center'>
                Вернуться на Главную страницу
            </a>
        </div>
    </main>
    <script src="/js/max4SeatsBooking.js"></script>
</body>

</html>