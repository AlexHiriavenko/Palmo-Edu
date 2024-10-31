<?php

session_start();
require '../vendor/autoload.php';

use Palmo\Database\Db;
use Palmo\Repository\FavoritesRepository;

$isLoggedIn = isset($_SESSION['userId']);
if (!$isLoggedIn) {
  header("Location: /login.php");
  exit();
}

$userId = $_SESSION['userId'];
$category = $_GET['category'] ?? '';
$page = (int)($_GET['page'] ?? 1);
$limit = 8;
$offset = ($page - 1) * $limit;

$db = new Db();
$favoritesRepository = new FavoritesRepository($db);
$events = $favoritesRepository->getFavoriteEvents($userId, $category, $limit, $offset);
$totalEvents = $favoritesRepository->countFavoriteEvents($userId, $category);
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