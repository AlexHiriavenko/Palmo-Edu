<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;

class SportEventModel extends CrudBaseModel
{
  protected string $table = 'sportEvents';

  // Метод для получения всех событий
  public function getAllEvents(): array
  {
    return $this->readAll($this->table);
  }

  // Метод для получения отфильтрованных событий
  public function getFilteredEvents(array $filters): array
  {
    return $this->readFiltered($this->table, $filters);
  }
}
