<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;

class OccupiedSeatsModel extends CrudBaseModel
{
  protected string $table = 'occupiedSeats';

  // Метод для получения всех занятых мест для конкретного события
  public function getOccupiedSeatsByEventId(int $eventId): array
  {
    return $this->readFiltered($this->table, ['eventId' => $eventId]);
  }
}
