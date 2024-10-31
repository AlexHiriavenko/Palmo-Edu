<?php

namespace Palmo\Repository;

use Palmo\Repository\BaseRepository;
use Palmo\Database\QueryBuilder;
use PDO;

class BookingRepository extends BaseRepository
{
    protected string $table = 'occupiedSeats';

    public function getUserSeats(int $eventId, int $userId): array
    {
        return array_column($this->readFiltered($this->table, ['eventId' => $eventId, 'userId' => $userId]), 'seatNumber');
    }


    public function addUserSeats(int $eventId, int $userId, array $seatNumbers): void
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


    public function removeUserSeats(int $eventId, int $userId, array $seatNumbers): void
    {
        if (empty($seatNumbers)) {
            return;
        }

        foreach ($seatNumbers as $seatNumber) {
            $records = $this->readFiltered($this->table, [
                'eventId' => $eventId,
                'userId' => $userId,
                'seatNumber' => $seatNumber
            ], 1);

            $recordId = $records[0]['id'];

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
        $existingBooking = $this->readFiltered('bookedEvents', ['userId' => $userId, 'eventId' => $eventId], 1);

        if (!empty($existingBooking)) {
            $this->delete('bookedEvents', $existingBooking[0]['id']);
        }
    }

    public function getBookedEvents(int $userId, ?string $category = null, int $limit = 8, int $offset = 0): array
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->table('sportEvents se')
            ->select(['se.*'])  // Выбираем все поля из sportEvents
            ->join('bookedEvents b', 'se.id', '=', 'b.eventId')
            ->where('b.userId', '=', $userId);

        if ($category) {
            $queryBuilder->where('se.category', '=', $category);
        }

        $queryBuilder->limit($limit)->offset($offset);
        // Получаем SQL и параметры для выполнения запроса
        $sql = $queryBuilder->getSelectSql();
        $bindings = $queryBuilder->getBindings();

        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindings);

        // Возвращаем результаты с eventId (se.id)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countBookedEvents(int $userId, ?string $category = null): int
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->table('sportEvents se')
            ->join('bookedEvents b', 'se.id', '=', 'b.eventId')
            ->where('b.userId', '=', $userId)
            ->count();

        if ($category && $category !== 'all') {
            $queryBuilder->where('se.category', '=', $category);
        }

        $stmt = $this->db->prepare($queryBuilder->getCountSql());
        $stmt->execute($queryBuilder->getBindings());
        return (int)$stmt->fetchColumn();
    }
}
