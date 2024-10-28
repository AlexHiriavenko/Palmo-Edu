<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Database/fillBaseFirstTime.php';

use Palmo\Database\Db;
use Palmo\Models\SportEventModel;
use Palmo\Service\AuthService;

$db = new Db();
$sportEventModel = new SportEventModel($db);
$authService = new AuthService($db);

// Заполняем базу данных, если она пуста
fillBaseFirstTime($sportEventModel, $db);

$authService->authenticateUser();
$userId = $_SESSION['userId'] ?? null;
$isLoggedIn = isset($_SESSION['userId']);

// Получаем выбранную категорию и номер страницы
$category = $_GET['category'] ?? 'all';
$page = (int)($_GET['page'] ?? 1);
$limit = 8;
$offset = ($page - 1) * $limit;

// Если выбрана категория, фильтруем события
if ($category !== 'all') {
    $events = $sportEventModel->getFilteredEvents(['category' => $category], $limit, $offset);
    $totalEvents = $sportEventModel->countFilteredEvents(['category' => $category]);
} else {
    // Если категория "all", получаем все события
    $events = $sportEventModel->getFilteredEvents([], $limit, $offset);
    $totalEvents = $sportEventModel->countFilteredEvents([]);
}

// Считаем общее количество страниц
$totalPages = ceil($totalEvents / $limit);

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
    <title>Sports Events</title>
</head>

<body class="bg-gray-900 text-white">
    <?php include './views/app_header.php'; ?>

    <main class="app-main views home p-4">
        <?php include './views/events-filter.php'; ?>
        <?php include './views/events-cards.php'; ?>
        <?php include './views/events-pagination.php'; ?>
    </main>
</body>

</html>