<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use Palmo\Database\Db;
use Palmo\Models\User\UserEventsModel;

header('Content-Type: application/json');

if (!isset($_SESSION['userId'])) {
  echo json_encode(['success' => false, 'message' => 'Требуется авторизация']);
  exit;
}

$db = new Db();
$userEventsModel = new UserEventsModel($db);
$userId = $_SESSION['userId'];

// Получаем данные из JSON-запроса
$data = json_decode(file_get_contents('php://input'), true);
$eventId = $data['eventId'] ?? null;

if ($eventId && is_numeric($eventId)) {
  // Переключаем состояние избранного
  $success = $userEventsModel->toggleFavorite($userId, (int)$eventId);
  echo json_encode(['success' => $success]);
} else {
  echo json_encode(['success' => false, 'message' => 'Неверный идентификатор события']);
}
