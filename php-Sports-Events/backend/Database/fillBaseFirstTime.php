<?php

use Palmo\Database\DB;
use Palmo\Repository\BaseRepository;
use Palmo\Repository\UserRepository;

/**
 * Функция для заполнения базы данных при первом запуске.
 * Использует существующее подключение к базе данных ($db).
 */
function fillBaseFirstTime(BaseRepository $baseRepository, Db $db)
{
  $pdo = $db->getPdoInstance();

  // Проверка наличия всех нужных таблиц и их заполненности
  $requiredTables = ['sportEvents', 'occupiedSeats', 'users', 'bookedEvents', 'favorites', 'user_tokens'];
  $existingTables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

  // Если все таблицы уже существуют и заполнены, завершаем выполнение
  $allTablesExist = empty(array_diff($requiredTables, $existingTables));
  if ($allTablesExist && !$baseRepository->rowsCount('sportEvents') && !$baseRepository->rowsCount('occupiedSeats') && !$baseRepository->rowsCount('users')) {
    return;
  }

  // Если таблиц не хватает или они пусты, продолжаем с созданием и заполнением
  $sqlFilePath = './mysql-init-scripts/01-create-tables.sql';
  $createTablesSQL = file_exists($sqlFilePath) ? file_get_contents($sqlFilePath) : '';

  if ($createTablesSQL && !$allTablesExist) {
    try {
      $pdo->exec($createTablesSQL);
    } catch (Exception $e) {
      echo "Ошибка при создании таблиц: " . $e->getMessage() . "\n";
      return;
    }
  }

  try {
    $pdo->beginTransaction();

    function isTableEmpty(BaseRepository $baseRepository, string $tableName): bool
    {
      return $baseRepository->rowsCount($tableName) === 0;
    }

    if (isTableEmpty($baseRepository, 'sportEvents') && isTableEmpty($baseRepository, 'occupiedSeats')) {

      // Чтение JSON-файлов
      $jsonFiles = ['./json-data/basketball.json', './json-data/football.json', './json-data/volleyball.json'];
      $events = [];

      foreach ($jsonFiles as $jsonFile) {
        if (file_exists($jsonFile)) {
          $fileContents = file_get_contents($jsonFile);
          $decodedData = json_decode($fileContents, true);
          if (is_array($decodedData)) {
            $events = array_merge($events, $decodedData);
          } else {
            echo "Ошибка при декодировании JSON: $jsonFile\n";
          }
        } else {
          echo "Файл не найден: $jsonFile\n";
        }
      }

      foreach ($events as $event) {
        $formattedDateTime = isset($event['dateTime']) ? date('Y-m-d H:i:s', strtotime($event['dateTime'])) : date('Y-m-d H:i:s');
        $eventData = [
          'name' => $event['name'] ?? 'Неизвестное событие',
          'category' => $event['category'] ?? 'Неизвестная категория',
          'location' => $event['location'] ?? 'Неизвестное место',
          'dateTime' => $formattedDateTime,
          'price' => $event['price'] ?? 0
        ];

        $baseRepository->create('sportEvents', $eventData);
        $eventId = $pdo->lastInsertId();

        if (!empty($event['occupiedSeats'])) {
          foreach ($event['occupiedSeats'] as $seatNumber) {
            $occupiedSeatData = [
              'eventId' => $eventId,
              'seatNumber' => $seatNumber
            ];
            $baseRepository->create('occupiedSeats', $occupiedSeatData);
          }
        }
      }
    }

    if (isTableEmpty($baseRepository, 'users')) {
      $userRepository = new UserRepository($db);
      $userRepository->createUser('admin', 'admin@admin.com', 'admin', 'admin');
    }

    $pdo->commit();
  } catch (PDOException $e) {
    $pdo->rollBack();
    echo "Ошибка при добавлении данных: " . $e->getMessage() . "\n";
  } catch (Exception $e) {
    echo "Общая ошибка: " . $e->getMessage() . "\n";
  }
}
