<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;

class OccupiedSeatsModel extends CrudBaseModel {
    protected string $table = 'occupiedSeats';

    public function getEventOccupiedSeats(int $eventId): array {
        return array_column($this->readFiltered($this->table, ['eventId' => $eventId]), 'seatNumber');
    }

    public function getEventOccupiedSeatsByUser(int $eventId, int $userId): array {
        return array_column($this->readFiltered($this->table, ['eventId' => $eventId, 'userId' => $userId]), 'seatNumber');
    }
}
