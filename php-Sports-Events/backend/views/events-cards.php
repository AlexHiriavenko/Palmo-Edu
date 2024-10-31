<?php

use Palmo\Repository\BookingRepository;
use Palmo\Repository\FavoritesRepository;

$favoritesRepository = new FavoritesRepository($db);
$bookingRepository = new BookingRepository($db);

$favoriteEventIds = $isLoggedIn ? $favoritesRepository->getFavoriteEventIds($userId) : [];

$current_page = basename($_SERVER['REQUEST_URI'], ".php");
$isBookingPage = $current_page === 'booking';

?>

<div class="container mx-auto">
    <?php if (!empty($events)): ?>
        <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6'>
            <?php foreach ($events as $event): ?>
                <?php $isFavorite = in_array($event->getId(), $favoriteEventIds ?? []); ?>
                <div class='bg-gray-800 bg-opacity-80 rounded-lg shadow-lg p-6 relative' style='min-height: 276px;'>
                    <h2 class='text-xl text-gray-200 font-bold mb-2 max-h-20 overflow-hidden text-ellipsis'>
                        <?= htmlspecialchars($event->getName() ?? 'Неизвестное событие') ?>
                    </h2>
                    <p class='text-sm text-gray-200'>Категория: <?= htmlspecialchars($event->getCategory() ?? 'Неизвестная категория') ?></p>
                    <p class='text-sm text-gray-200'>Место: <?= htmlspecialchars($event->getLocation() ?? 'Неизвестное место') ?></p>
                    <p class='text-sm text-gray-200'>Дата: <?= htmlspecialchars($event->getDateTime()->format('Y-m-d H:i')) ?></p>
                    <p class='text-sm text-gray-200'>Цена: $<?= htmlspecialchars($event->getPrice() !== null ? $event->getPrice() : 0) ?></p>
                    <?php if ($isBookingPage && $isLoggedIn): ?>
                        <?php
                        $userSeats = $bookingRepository->getUserSeats($event->getId(), $userId) ?? [];
                        $userSeats = implode(', ', $userSeats); ?>
                        <p class='text-sm text-gray-200'>Забронированные места: <?= htmlspecialchars($userSeats) ?></p>
                    <?php endif; ?>

                    <a href="<?= $event->getId() ? 'event-details.php?id=' . htmlspecialchars($event->getId()) : '404.php' ?>"
                        class='mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600'>
                        Узнать больше
                    </a>

                    <!-- Кнопка звездочки, видимая только для авторизованных пользователей -->
                    <?php if ($isLoggedIn): ?>
                        <button
                            class="absolute bottom-8 right-4 text-3xl favorite-toggle <?= $isFavorite ? 'text-orange-500' : 'text-white' ?>"
                            data-event-id="<?= $event->getId() ?>">
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
<script src="/js/toggleFavorite.js"></script>