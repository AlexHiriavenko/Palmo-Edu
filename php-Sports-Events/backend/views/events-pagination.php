<?php ?>

<div class="mt-6">
    <?php if ($totalPages > 1): ?>
        <nav>
            <ul class="flex flex-wrap gap-y-6 justify-center space-x-4">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <a href="?page=<?= $i ?>&category=<?= $category ?>" class="px-3 py-2 bg-gray-700 rounded text-white <?= $page == $i ? 'bg-blue-500' : '' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>