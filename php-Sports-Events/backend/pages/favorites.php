<?php

session_start();
require '../vendor/autoload.php';

use Palmo\Database\Db;
use Palmo\Repository\FavoritesRepository;
use Palmo\Service\AuthService;

$db = new Db();
$authService = new AuthService($db);
$favoritesRepository = new FavoritesRepository($db);

$user = $authService->authenticateUser();

$userId = $user ? $user->getId() : null;
$isLoggedIn = $user && $userId;

if (!$isLoggedIn) {
  header("Location: /login.php");
  exit;
}

$category = $_GET['category'] ?? '';
$page = (int)($_GET['page'] ?? 1);
const LIMIT = 8;
$offset = ($page - 1) * LIMIT;

$events = $favoritesRepository->getFavoriteEvents($userId, $category, LIMIT, $offset);
$totalEvents = $favoritesRepository->countFavoriteEvents($userId, $category);
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
  <title>Favorite Events</title>
</head>

<body class="bg-gray-900 text-white">
  <?php include '../views/app_header.php'; ?>
  <main class="app-main views favorites p-4">
    <?php include '../views/events-filter.php'; ?>
    <?php include '../views/events-cards.php'; ?>
    <?php include '../views/events-pagination.php'; ?>
  </main>
</body>

</html>