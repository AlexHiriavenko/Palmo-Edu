<?php ?>

<div class="container mx-auto">
    <?php if (!empty($events)): ?>
        <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6'>
            <?php foreach ($events as $event): ?>
                <div class='bg-gray-800 bg-opacity-80 rounded-lg shadow-lg p-6' style='min-height: 276px;'>
                    <h2 class='text-xl text-gray-200 font-bold mb-2 max-h-20 overflow-hidden text-ellipsis'>
                        <?= htmlspecialchars($event['name'] ?? 'Неизвестное событие') ?>
                    </h2>
                    <p class='text-sm text-gray-200'>Категория: <?= htmlspecialchars($event['category'] ?? 'Неизвестная категория') ?></p>
                    <p class='text-sm text-gray-200'>Место: <?= htmlspecialchars($event['location'] ?? 'Неизвестное место') ?></p>
                    <p class='text-sm text-gray-200'>Дата: <?= htmlspecialchars($event['dateTime']) ?></p>
                    <p class='text-sm text-gray-200'>Цена: $<?= htmlspecialchars($event['price'] !== null ? $event['price'] : 0) ?></p>
                    <button class='mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600'>
                        Узнать больше
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class='text-center'>Список событий пуст.</p>
    <?php endif; ?>
</div>