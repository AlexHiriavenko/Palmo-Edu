<?php

use Palmo\Database\CrudBaseModel;
use Palmo\Database\DB;

/**
 * Функция для заполнения базы данных при первом запуске.
 * Использует существующее подключение к базе данных ($db).
 */
function fillBaseFirstTime(CrudBaseModel $crudModel, Db $db)
{
  $pdo = $db->getPdoInstance();  // Получаем экземпляр PDO

  try {
    // Начинаем транзакцию
    $pdo->beginTransaction();

    // Загружаем SQL-запросы из файла
    $sqlFilePath = './mysql-init-scripts/01-create-tables.sql';
    if (file_exists($sqlFilePath)) {
      $createTablesSQL = file_get_contents($sqlFilePath);

      // Выполняем SQL-запросы
      $pdo->exec($createTablesSQL);
    } else {
      throw new Exception("SQL-файл не найден: $sqlFilePath");
    }

    // Функция для проверки, пуста ли таблица
    function isTableEmpty(CrudBaseModel $crudModel, string $tableName): bool
    {
      return $crudModel->rowsCount($tableName) === 0;
    }

    // Проверяем таблицы перед началом вставки данных
    if (isTableEmpty($crudModel, 'sportEvents') && isTableEmpty($crudModel, 'occupiedSeats')) {

      // Чтение JSON-файлов
      $jsonFiles = ['./json-data/basketball.json', './json-data/football.json', './json-data/volleyball.json'];
      $events = [];

      // Объединение данных из всех файлов
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

      // Перебор всех событий и вставка данных
      foreach ($events as $event) {
        if (isset($event['dateTime'])) {
          $formattedDateTime = date('Y-m-d H:i:s', strtotime($event['dateTime']));
        } else {
          $formattedDateTime = date('Y-m-d H:i:s');
          echo "Warning: Отсутствует поле 'dateTime' для события: " . json_encode($event) . "\n";
        }

        $eventData = [
          'name' => $event['name'] ?? 'Неизвестное событие',
          'category' => $event['category'] ?? 'Неизвестная категория',
          'location' => $event['location'] ?? 'Неизвестное место',
          'dateTime' => $formattedDateTime,
          'price' => $event['price'] !== null ? $event['price'] : 0
        ];

        $crudModel->create('sportEvents', $eventData);

        $eventId = $pdo->lastInsertId();

        if (!empty($event['occupiedSeats'])) {
          foreach ($event['occupiedSeats'] as $seatNumber) {
            $occupiedSeatData = [
              'eventId' => $eventId,
              'seatNumber' => $seatNumber
            ];
            $crudModel->create('occupiedSeats', $occupiedSeatData);
          }
        }
      }

      // Фиксируем изменения
      $pdo->commit();
    }
  } catch (PDOException $e) {
    $pdo->rollBack();
    echo "Ошибка при добавлении данных: " . $e->getMessage() . "\n";
  } catch (Exception $e) {
    echo "Общая ошибка: " . $e->getMessage() . "\n";
  }
}
