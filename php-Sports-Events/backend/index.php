<?php
require __DIR__ . '/vendor/autoload.php';

use Palmo\Source\Db;

$db = new Db();
$pdo = $db->getHandler();

try {
    // Начинаем транзакцию
    $pdo->beginTransaction();

    // Чтение JSON-файла
    $jsonFile = file_get_contents('./json-data/basketball.json');
    $events = json_decode($jsonFile, true);

    // Перебор событий и вставка данных
    foreach ($events as $event) {
        // Преобразуем дату и время в формат 'YYYY-MM-DD HH:MM:SS'
        $formattedDateTime = date('Y-m-d H:i:s', strtotime($event['dateTime']));

        // Проверка, существует ли уже событие с таким именем и датой
        $checkEvent = $pdo->prepare("SELECT id FROM sportEvents WHERE name = :name AND dateTime = :dateTime");
        $checkEvent->execute([
            ':name' => $event['name'],
            ':dateTime' => $formattedDateTime
        ]);

        if ($checkEvent->rowCount() > 0) {
            // Событие уже существует, пропускаем вставку
            echo "Событие уже существует: " . $event['name'] . "\n";
            $eventId = $checkEvent->fetch(PDO::FETCH_COLUMN); // Получаем существующий ID события
        } else {
            // Вставляем новое событие
            $stmt = $pdo->prepare("INSERT INTO sportEvents (name, category, location, dateTime, price)
                                   VALUES (:name, :category, :location, :dateTime, :price)");
            $stmt->execute([
                ':name' => $event['name'],
                ':category' => $event['category'],
                ':location' => $event['location'],
                ':dateTime' => $formattedDateTime,
                ':price' => $event['price'] !== null ? $event['price'] : 0 // Если цена null, ставим 0
            ]);

            // Получаем ID вставленного события
            $eventId = $pdo->lastInsertId();

            echo "Новое событие добавлено: " . $event['name'] . "\n";
        }

        // Проверяем и вставляем занятые места
        if (!empty($event['occupiedSeats'])) {
            foreach ($event['occupiedSeats'] as $seatNumber) {
                // Проверяем, существует ли уже запись для этого места и события
                $checkSeat = $pdo->prepare("SELECT id FROM occupiedSeats WHERE eventId = :eventId AND seatNumber = :seatNumber");
                $checkSeat->execute([
                    ':eventId' => $eventId,
                    ':seatNumber' => $seatNumber
                ]);

                if ($checkSeat->rowCount() > 0) {
                    // Место уже занято, пропускаем вставку
                    echo "Место $seatNumber для события " . $event['name'] . " уже занято.\n";
                } else {
                    // Вставляем новое занятое место
                    $stmt = $pdo->prepare("INSERT INTO occupiedSeats (eventId, seatNumber) VALUES (:eventId, :seatNumber)");
                    $stmt->execute([
                        ':eventId' => $eventId,
                        ':seatNumber' => $seatNumber
                    ]);
                    echo "Место $seatNumber для события " . $event['name'] . " добавлено.\n";
                }
            }
        }
    }

    // Если все запросы прошли успешно, фиксируем изменения
    $pdo->commit();
    echo "Все изменения были успешно сохранены.\n";
} catch (PDOException $e) {
    // Если произошла ошибка, откатываем изменения
    $pdo->rollBack();
    echo "Ошибка при добавлении данных: " . $e->getMessage() . "\n";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./public/imgs/football.ico">
    <link rel="stylesheet" href="./public/styles/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/styles.css">
    <title>Sports Events</title>
</head>

<body>
    <?php include './views/app_header.php'; ?>
    <main class="app-main views home">
        <?php
        $password = 'admin';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo $hashedPassword;
        ?>
    </main>
</body>

</html>