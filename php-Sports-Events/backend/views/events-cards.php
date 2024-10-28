<?php

use Palmo\Models\User\UserEventsModel;

$userEventsModel = new UserEventsModel($db);

$favoriteEventIds = is_numeric($userId) ? $userEventsModel->getFavoriteEventIds($userId) : [];
?>

<div class="container mx-auto">
    <?php if (!empty($events)): ?>
        <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6'>
            <?php foreach ($events as $event): ?>
                <?php $isFavorite = in_array($event['id'], $favoriteEventIds ?? []); ?>
                <div class='bg-gray-800 bg-opacity-80 rounded-lg shadow-lg p-6 relative' style='min-height: 276px;'>
                    <h2 class='text-xl text-gray-200 font-bold mb-2 max-h-20 overflow-hidden text-ellipsis'>
                        <?= htmlspecialchars($event['name'] ?? 'Неизвестное событие') ?>
                    </h2>
                    <p class='text-sm text-gray-200'>Категория: <?= htmlspecialchars($event['category'] ?? 'Неизвестная категория') ?></p>
                    <p class='text-sm text-gray-200'>Место: <?= htmlspecialchars($event['location'] ?? 'Неизвестное место') ?></p>
                    <p class='text-sm text-gray-200'>Дата: <?= htmlspecialchars($event['dateTime']) ?></p>
                    <p class='text-sm text-gray-200'>Цена: $<?= htmlspecialchars($event['price'] !== null ? $event['price'] : 0) ?></p>
                    <a href="<?= isset($event['id']) ? 'event-details.php?id=' . htmlspecialchars($event['id']) : '404.php' ?>"
                        class='mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600'>
                        Узнать больше
                    </a>

                    <!-- Кнопка звездочки, видимая только для авторизованных пользователей -->
                    <?php if ($isLoggedIn): ?>
                        <button
                            class="absolute bottom-8 right-4 text-3xl favorite-toggle <?= $isFavorite ? 'text-orange-500' : 'text-white' ?>"
                            data-event-id="<?= $event['id'] ?>">
                            &#9733;
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class='text-center'>Список событий пуст.</p>
    <?php endif; ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.favorite-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event-id');

                fetch('/controller/toggle_favorite.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            eventId: eventId
                        })
                    })
                    .then(response => response.text()) // Используем .text() для отладки
                    .then(text => {
                        console.log("Response Text:", text); // Выводим ответ на консоль
                        const data = JSON.parse(text); // Парсим JSON после вывода
                        if (data.success) {
                            this.classList.toggle('text-orange-500');
                            this.classList.toggle('text-white');
                        } else {
                            alert('Не удалось обновить избранное. Пожалуйста, попробуйте снова.');
                        }
                    })
                    .catch(error => console.error('Ошибка:', error));
            });
        });
    });
</script>