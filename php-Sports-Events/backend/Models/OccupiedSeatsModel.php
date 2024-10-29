<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;

// class OccupiedSeatsModel extends CrudBaseModel
// {
//   protected string $table = 'occupiedSeats';

//   // Возвращаем номера всех занятых мест для события
//   public function getEventOccupiedSeats(int $eventId): array
//   {
//     $occupiedSeats = $this->readFiltered($this->table, ['eventId' => $eventId]);
//     return array_column($occupiedSeats, 'seatNumber'); // Возвращаем только номера мест
//   }

//   // Возвращаем номера мест, занятых текущим пользователем для события
//   public function getEventOccupiedSeatsByUser(int $eventId, int $userId): array
//   {
//     $userOccupiedSeats = $this->readFiltered($this->table, ['eventId' => $eventId, 'userId' => $userId]);
//     return array_column($userOccupiedSeats, 'seatNumber'); // Возвращаем только номера мест
//   }
// }

class OccupiedSeatsModel extends CrudBaseModel {
    protected string $table = 'occupiedSeats';

    public function batchAddOccupiedSeats(int $eventId, int $userId, array $seatNumbers): void {
        foreach ($seatNumbers as $seatNumber) {
            $this->create($this->table, ['eventId' => $eventId, 'userId' => $userId, 'seatNumber' => $seatNumber]);
        }
    }

    public function batchRemoveOccupiedSeats(int $eventId, int $userId, array $seatNumbers): void {
        foreach ($seatNumbers as $seatNumber) {
            $this->deleteWithConditions($this->table, ['eventId' => $eventId, 'userId' => $userId, 'seatNumber' => $seatNumber]);
        }
    }

    public function getEventOccupiedSeats(int $eventId): array {
        return array_column($this->readFiltered($this->table, ['eventId' => $eventId]), 'seatNumber');
    }

    public function getEventOccupiedSeatsByUser(int $eventId, int $userId): array {
        return array_column($this->readFiltered($this->table, ['eventId' => $eventId, 'userId' => $userId]), 'seatNumber');
    }
}
