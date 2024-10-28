<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;
use Palmo\Database\QueryBuilder;
use PDO;

class SportEventModel extends CrudBaseModel
{
  protected string $table = 'sportEvents';

  // Получение событий с фильтрацией и пагинацией
  public function getFilteredEvents(?string $category = null, int $limit = 8, int $offset = 0): array
  {
    $queryBuilder = new QueryBuilder();
    $queryBuilder->table($this->table)->select(['*']);

    // Добавляем фильтр по категории, если он задан
    if ($category && $category !== 'all') {
      $queryBuilder->where('category', '=', $category);
    }

    $queryBuilder->limit($limit)->offset($offset);

    // Выполняем запрос и возвращаем результаты
    $sql = $queryBuilder->getSelectSql();
    $bindings = $queryBuilder->getBindings();
    $stmt = $this->db->prepare($sql);
    $stmt->execute($bindings);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}

