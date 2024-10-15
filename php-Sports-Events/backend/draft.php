<?php
require __DIR__ . '/vendor/autoload.php';

use Palmo\Source\Db;

try {
  $dsn = "mysql:host=db;dbname=sports_events;charset=utf8mb4";
  $username = "root";
  $password = "123";

  $pdo = new PDO($dsn, $username, $password);
  echo "Connection successful!";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$db = new Db();
$pdo = $db->getHandler();

$query = $pdo->query('SHOW DATABASES');
$dbs = $query->fetchAll(PDO::FETCH_COLUMN);

echo '<pre>';
print_r($dbs);
echo '</pre>';
