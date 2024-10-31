<?php ?>

<div class="mb-6 mx-auto w-64">
    <form action="" method="GET">
        <label for="category" class="text-lg text-gray-200 font-semibold">Фильтровать по:</label>
        <select name="category" id="category" onchange="this.form.submit()" class="text-gray-800 text-center">
            <option value="" <?= !isset($_GET['category']) || $_GET['category'] === '' ? 'selected' : '' ?>>All</option>
            <option value="soccer" <?= isset($_GET['category']) && $_GET['category'] === 'soccer' ? 'selected' : '' ?>>Football</option>
            <option value="volleyball" <?= isset($_GET['category']) && $_GET['category'] === 'volleyball' ? 'selected' : '' ?>>Volleyball</option>
            <option value="basketball" <?= isset($_GET['category']) && $_GET['category'] === 'basketball' ? 'selected' : '' ?>>Basketball</option>
        </select>
    </form>
</div>