<?php

namespace Palmo\Repository;

use Palmo\Repository\BaseRepository;
use Palmo\Database\QueryBuilder;
use Palmo\Model\Event;
use PDO;

class EventRepository extends BaseRepository
{
  protected string $table = 'sportEvents';

  public function getEventByID($eventId): ?Event
  {
    $eventData = $this->readById($this->table, $eventId);

    if ($eventData) {
      return new Event(
        $eventData['id'],
        $eventData['name'],
        $eventData['category'],
        $eventData['location'],
        new \DateTime($eventData['dateTime']),
        (float)$eventData['price']
      );
    }

    return null;
  }

  // Получение событий с фильтрацией и пагинацией
  public function getPaginationEventsByCategory(?string $category = null, int $limit = 8, int $offset = 0): array
  {
    $queryBuilder = new QueryBuilder();
    $queryBuilder->table($this->table)->select(['*']);

    // Добавляем фильтр по категории, если он задан
    if ($category) {
      $queryBuilder->where('category', '=', $category);
    }

    $queryBuilder->limit($limit)->offset($offset);

    // Выполняем запрос и возвращаем результаты
    $sql = $queryBuilder->getSelectSql();
    $bindings = $queryBuilder->getBindings();
    $stmt = $this->db->prepare($sql);
    $stmt->execute($bindings);

    $eventDataArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return array_map(
      fn($eventData) => new Event(
        $eventData['id'],
        $eventData['name'],
        $eventData['category'],
        $eventData['location'],
        new \DateTime($eventData['dateTime']),
        (float)$eventData['price']
      ),
      $eventDataArray
    );
  }

  // Подсчёт количества событий с фильтрацией
  public function countFilteredEvents(?string $category = null): int
  {
    $queryBuilder = new QueryBuilder();
    $queryBuilder->table($this->table)->count();

    // Добавляем фильтр по категории, если он задан
    if ($category && $category !== 'all') {
      $queryBuilder->where('category', '=', $category);
    }

    $sql = $queryBuilder->getCountSql();
    $bindings = $queryBuilder->getBindings();
    $stmt = $this->db->prepare($sql);
    $stmt->execute($bindings);

    return (int)$stmt->fetchColumn();
  }

  public function getEventOccupiedSeats(int $eventId): array
  {
    return array_column($this->readFiltered('occupiedSeats', ['eventId' => $eventId]), 'seatNumber');
  }
}
