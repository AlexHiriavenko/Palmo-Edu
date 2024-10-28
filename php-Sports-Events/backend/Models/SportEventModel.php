<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;

class SportEventModel extends CrudBaseModel
{
  protected string $table = 'sportEvents';

  // Получение всех событий
  public function getAllEvents(): array
  {
    return $this->readAll($this->table);
  }

  // Получение событий с фильтрацией и пагинацией
  public function getFilteredEvents(array $filters = [], int $limit = 8, int $offset = 0): array
  {
    return $this->readFiltered($this->table, $filters, $limit, $offset);
  }

  // Подсчёт количества событий с фильтрацией
  public function countFilteredEvents(array $filters = []): int
  {
    return $this->countFiltered($this->table, $filters);
  }

  public function getEventsByIds(array $eventIds, int $limit = 8, int $offset = 0): array
  {
    $filters = ['id' => $eventIds];
    return $this->readFiltered($this->table, $filters, $limit, $offset);
  }
}
