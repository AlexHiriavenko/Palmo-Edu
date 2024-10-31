<?php
session_start();
require '../vendor/autoload.php';
require_once '../Database/fillBaseFirstTime.php';

use Palmo\Database\Db;
use Palmo\Service\AuthService;

$db = new Db();
$authService = new AuthService($db);

$user = $authService->authenticateUser();

$userId = $user ? $user->getId() : null;
$isLoggedIn = $user && $userId;
$isAdmin = $isLoggedIn && $user->getRole() === 'admin';

if (!$isLoggedIn || !$isAdmin) {
  header("Location: /404.php");
  exit;
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
  <main class="app-main views">
    <h1 class="text-3xl text-center mt-16 text-white">Admin Page</h1>
  </main>
</body>

</html>