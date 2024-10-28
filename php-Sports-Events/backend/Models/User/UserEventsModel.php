<?php

namespace Palmo\Models\User;

use Palmo\Database\CrudBaseModel;

class UserEventsModel extends CrudBaseModel
{
  public function getFavoriteEventIds(int $userId): array
  {
    if (!is_numeric($userId)) return [];
    // Получаем только eventId для избранных событий
    $favorites = $this->readFiltered(
      'favorites',
      ['userId' => $userId]
    );

    return array_column($favorites, 'eventId');
  }

  // Метод для переключения состояния избранного
  public function toggleFavorite(int $userId, int $eventId): bool
  {
    $existingFavorite = $this->readFiltered('favorites', ['userId' => $userId, 'eventId' => $eventId], 1);

    if (!empty($existingFavorite)) {
      // Если событие уже в избранном, удаляем
      return $this->delete('favorites', $existingFavorite[0]['id']);
    } else {
      // Если события нет в избранном, добавляем
      $data = [
        'userId' => $userId,
        'eventId' => $eventId
      ];
      return $this->create('favorites', $data);
    }
  }
}
