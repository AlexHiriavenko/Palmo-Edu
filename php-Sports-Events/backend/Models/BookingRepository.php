<?php

namespace Palmo\Models;

use Palmo\Database\CrudBaseModel;

class BookingRepository extends CrudBaseModel
{
    protected string $table = 'occupiedSeats';

    public function getEventOccupiedSeats(int $eventId): array
    {
        return array_column($this->readFiltered($this->table, ['eventId' => $eventId]), 'seatNumber');
    }

    public function getEventOccupiedSeatsByUser(int $eventId, int $userId): array
    {
        return array_column($this->readFiltered($this->table, ['eventId' => $eventId, 'userId' => $userId]), 'seatNumber');
    }

    public function batchAddOccupiedSeats(int $eventId, int $userId, array $seatNumbers): void
    {

        if (empty($seatNumbers)) {
            return;
        }

        foreach ($seatNumbers as $seatNumber) {
            $existingSeat = $this->readFiltered($this->table, ['eventId' => $eventId, 'seatNumber' => $seatNumber], 1);
            if (empty($existingSeat)) {
                $this->create($this->table, [
                    'eventId' => $eventId,
                    'userId' => $userId,
                    'seatNumber' => $seatNumber
                ]);
            }
        }
    }

    public function batchRemoveOccupiedSeats(int $eventId, int $userId, array $seatNumbers): void
    {
        if (empty($seatNumbers)) {
            return;
        }

        foreach ($seatNumbers as $seatNumber) {
            // Получаем запись по eventId, userId и seatNumber
            $records = $this->readFiltered($this->table, [
                'eventId' => $eventId,
                'userId' => $userId,
                'seatNumber' => $seatNumber
            ], 1);

            $recordId = $records[0]['id'];

            // Если запись найдена, удаляем по id
            if (!empty($records)) {
                $this->delete($this->table, $recordId);
            }
        }
    }

    public function addToBookedEvents(int $userId, int $eventId): void
    {
        $existingBooking = $this->readFiltered('bookedEvents', ['userId' => $userId, 'eventId' => $eventId], 1);

        if (empty($existingBooking)) {
            $this->create('bookedEvents', [
                'userId' => $userId,
                'eventId' => $eventId
            ]);
        }
    }

    public function removeFromBookedEvents(int $userId, int $eventId): void
    {
        // Получаем запись по userId и eventId
        $existingBooking = $this->readFiltered('bookedEvents', ['userId' => $userId, 'eventId' => $eventId], 1);

        // Если запись найдена, удаляем ее
        if (!empty($existingBooking)) {
            $this->delete('bookedEvents', $existingBooking[0]['id']);
        }
    }
}
