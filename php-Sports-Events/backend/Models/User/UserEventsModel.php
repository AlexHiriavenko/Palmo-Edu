<?php

namespace Palmo\Models\User;

use Palmo\Database\CrudBaseModel;
use Palmo\Database\QueryBuilder;
use Palmo\Database\Db;
use PDO;

class UserEventsModel extends CrudBaseModel
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

    // Возвращаем результаты с правильным eventId (se.id)
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public function countFavoriteEvents(int $userId, ?string $category = null): int
  {
    $queryBuilder = new QueryBuilder();
    $queryBuilder->table('sportEvents se')
      ->join('favorites f', 'se.id', '=', 'f.eventId')
      ->where('f.userId', '=', $userId)
      ->count();

    if ($category && $category !== 'all') {
      $queryBuilder->where('se.category', '=', $category);
    }

    $sql = $queryBuilder->getCountSql();
    $bindings = $queryBuilder->getBindings();

    $stmt = $this->db->prepare($sql);
    $stmt->execute($bindings);

    return (int) $stmt->fetchColumn();
  }
}
