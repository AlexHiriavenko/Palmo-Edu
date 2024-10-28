<?php
session_start();
require '../vendor/autoload.php';
require_once '../Database/fillBaseFirstTime.php';

use Palmo\Database\Db;
use Palmo\Models\SportEventModel;
use Palmo\Service\AuthService;
use Palmo\Models\User\UserEventsModel;

$db = new Db();
$sportEventModel = new SportEventModel($db);
$authService = new AuthService($db);

// Заполняем базу данных, если она пуста
fillBaseFirstTime($sportEventModel, $db);

$authService->authenticateUser();
$userId = $_SESSION['userId'] ?? null;
$isLoggedIn = isset($_SESSION['userId']);

if (!$isLoggedIn) {
  header("Location: /login.php");
  exit();
}

// Получаем избранные события пользователя
$userEventsModel = new UserEventsModel($db);
$favoriteEventIds = $userEventsModel->getFavoriteEventIds($userId);
$limit = 8;
$offset = 0;
// Получаем сами события на основе IDs избранных
$events = !empty($favoriteEventIds)
  ? $sportEventModel->getEventsByIds($favoriteEventIds, $limit, $offset)
  : [];

// Подсчёт общего количества избранных событий
$totalEvents = count($favoriteEventIds);
$totalPages = ceil($totalEvents / $limit);

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
  <title>Favorites Events</title>
</head>

<body>
  <?php include '../views/app_header.php'; ?>
  <main class="app-main views home p-4">
    <?php include '../views/events-filter.php'; ?>
    <?php include '../views/events-cards.php'; ?>
    <?php include '../views/events-pagination.php'; ?>
  </main>
</body>

</html>