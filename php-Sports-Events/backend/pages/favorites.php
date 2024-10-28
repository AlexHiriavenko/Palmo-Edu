<?php
session_start();
require '../vendor/autoload.php';

use Palmo\Database\Db;

$db = new Db();
$pdo = $db->getPdoInstance();

$isLoggedIn = isset($_SESSION['userId']);
$userId = $_SESSION['userId'] ?? null;
if (!$userId) {
  echo "Необходима авторизация";
  exit;
}

$category = $_GET['category'] ?? 'all';
$page = $_GET['page'] ?? 1;
$limit = 8;
$offset = ($page - 1) * $limit;

// Запрос для получения событий
$sql = "SELECT se.* FROM sportEvents se
        JOIN favorites f ON se.id = f.eventId
        WHERE f.userId = :userId";

if ($category !== 'all') {
  $sql .= " AND se.category = :category";
}

$sql .= " LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
if ($category !== 'all') {
  $stmt->bindValue(':category', $category, PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Подсчёт общего количества избранных событий
$countSql = "SELECT COUNT(*) FROM sportEvents se
             JOIN favorites f ON se.id = f.eventId
             WHERE f.userId = :userId";

if ($category !== 'all') {
  $countSql .= " AND se.category = :category";
}

$countStmt = $pdo->prepare($countSql);
$countStmt->bindValue(':userId', $userId, PDO::PARAM_INT);
if ($category !== 'all') {
  $countStmt->bindValue(':category', $category, PDO::PARAM_STR);
}
$countStmt->execute();

$totalEvents = (int) $countStmt->fetchColumn();
$totalPages = ceil($totalEvents / $limit);
?>

<!-- Вывод в HTML -->
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