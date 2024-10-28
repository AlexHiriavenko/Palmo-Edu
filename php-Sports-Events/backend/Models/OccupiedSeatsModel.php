<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;

// class OccupiedSeatsModel extends CrudBaseModel
// {
//   protected string $table = 'occupiedSeats';

//   // Метод для получения всех занятых мест для конкретного события
//   public function getOccupiedSeatsByEventId(int $eventId): array
//   {
//     return $this->readFiltered($this->table, ['eventId' => $eventId]);
//   }
// }

class OccupiedSeatsModel extends CrudBaseModel
{
  protected string $table = 'occupiedSeats';

  // Возвращаем номера всех занятых мест для события
  public function getEventOccupiedSeats(int $eventId): array
  {
    $occupiedSeats = $this->readFiltered($this->table, ['eventId' => $eventId]);
    return array_column($occupiedSeats, 'seatNumber'); // Возвращаем только номера мест
  }

  // Возвращаем номера мест, занятых текущим пользователем для события
  public function getEventOccupiedSeatsByUser(int $eventId, int $userId): array
  {
    $userOccupiedSeats = $this->readFiltered($this->table, ['eventId' => $eventId, 'userId' => $userId]);
    return array_column($userOccupiedSeats, 'seatNumber'); // Возвращаем только номера мест
  }
}