<?php
session_start();
require '../vendor/autoload.php';
require_once '../Database/fillBaseFirstTime.php';

use Palmo\Database\Db;
use Palmo\Models\SportEventModel;
use Palmo\Service\AuthService;

$db = new Db();
$sportEventModel = new SportEventModel($db);
$authService = new AuthService($db);

// Заполняем базу данных, если она пуста
fillBaseFirstTime($sportEventModel, $db);

$authService->authenticateUser();
$isLoggedIn = isset($_SESSION['userId']);

if (!$isLoggedIn) {
  header("Location: /login.php");
  exit();
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
  <title>Favorites Events</title>
</head>

<body>
  <?php include '../views/app_header.php'; ?>
  <main class="app-main views favorites"></main>
</body>

</html>