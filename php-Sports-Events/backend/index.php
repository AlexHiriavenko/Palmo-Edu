<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Database/fillBaseFirstTime.php';

use Palmo\Database\Db;
use Palmo\Repository\EventRepository;
use Palmo\Service\AuthService;

$db = new Db();
$eventRepository = new EventRepository($db);
$authService = new AuthService($db);

// Заполняем базу данных, если она пуста
fillBaseFirstTime($eventRepository, $db);

$user = $authService->authenticateUser();

$userId = $user ? $user->getId() : null;
$isLoggedIn = $user && $userId;

// Получаем выбранную категорию и номер страницы
$category = $_GET['category'] ?? '';
$page = (int)($_GET['page'] ?? 1);
const LIMIT = 8;
$offset = ($page - 1) * LIMIT;

// Получаем события и общее количество страниц
$events = $eventRepository->getPaginationEventsByCategory($category, LIMIT, $offset);
$totalEvents = $eventRepository->countFilteredEvents($category);
$totalPages = ceil($totalEvents / LIMIT);

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