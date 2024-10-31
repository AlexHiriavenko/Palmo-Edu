<?php

namespace Palmo\Repository;

use PDO;
use Palmo\Database\QueryBuilder;
use Palmo\Repository\BaseRepository;
use Palmo\Model\Event;


class FavoritesRepository extends BaseRepository
{
  public function getFavoriteEventIds(int $userId): array
  {
    $favorites = $this->readFiltered('favorites', ['userId' => $userId]);
    return array_column($favorites, 'eventId');
  }

  public function toggleFavorite(int $userId, int $eventId): bool
  {
    $existingFavorite = $this->readFiltered('favorites', ['userId' => $userId, 'eventId' => $eventId], 1);

    if (!empty($existingFavorite)) {
      return $this->delete('favorites', $existingFavorite[0]['id']);
    } else {
      return $this->create('favorites', ['userId' => $userId, 'eventId' => $eventId]);
    }
  }

  public function getFavoriteEvents(int $userId, ?string $category = null, int $limit = 8, int $offset = 0): array
  {
    $queryBuilder = new QueryBuilder();
    $queryBuilder->table('sportEvents se')
      ->select(['se.*'])  // Выбираем все поля из sportEvents
      ->join('favorites f', 'se.id', '=', 'f.eventId')
      ->where('f.userId', '=', $userId);

    if ($category && $category !== 'all') {
      $queryBuilder->where('se.category', '=', $category);
    }

    $queryBuilder->limit($limit)->offset($offset);

    // Получаем SQL и параметры для выполнения запроса
    $sql = $queryBuilder->getSelectSql();
    $bindings = $queryBuilder->getBindings();

    $stmt = $this->db->prepare($sql);
    $stmt->execute($bindings);

    // Обрабатываем результаты в массив объектов Event
    $eventsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return array_map(
      fn($eventData) => new Event(
        $eventData['id'],
        $eventData['name'],
        $eventData['category'],
        $eventData['location'],
        new \DateTime($eventData['dateTime']),
        (float)$eventData['price']
      ),
      $eventsData
    );
  }


  public function countFavoriteEvents(int $userId, ?string $category = null): int
  {
    $queryBuilder = new QueryBuilder();
    $queryBuilder->table('sportEvents se')
      ->join('favorites f', 'se.id', '=', 'f.eventId')
      ->where('f.userId', '=', $userId)
      ->count();

    if ($category) {
      $queryBuilder->where('se.category', '=', $category);
    }

    $sql = $queryBuilder->getCountSql();
    $bindings = $queryBuilder->getBindings();

    $stmt = $this->db->prepare($sql);
    $stmt->execute($bindings);

    return (int) $stmt->fetchColumn();
  }
}
