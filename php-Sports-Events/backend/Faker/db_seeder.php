<?php

use Palmo\Source\Db;

require_once '../vendor/autoload.php';

set_time_limit(0);

$dbh = (new Db())->getHandler();

$dbh->query("
    CREATE TABLE IF NOT EXISTS addresses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        street VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL
    )
");

// Создание таблицы users, если она не существует
$dbh->query("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        address_id INT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        age INT,
        FOREIGN KEY (address_id) REFERENCES addresses(id) ON DELETE CASCADE
    )
");

// Создание таблицы categories, если она не существует
$dbh->query("
    CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )
");

// Создание таблицы posts, если она не существует
$dbh->query("
    CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        category_id INT,
        title VARCHAR(255) NOT NULL,
        body TEXT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
    )
");

$faker = Faker\Factory::create();
$faker->addProvider(new Faker\Provider\en_US\Address($faker));
$faker->addProvider(new Faker\Provider\en_US\Person($faker));
$faker->addProvider(new Faker\Provider\en_US\Company($faker));
$faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
$faker->addProvider(new Faker\Provider\en_US\Text($faker));


if (!empty($_POST['addresses_amount'])) {
    $addressesAmount = $_POST['addresses_amount'];
    for ($i = 0; $i <= $addressesAmount; $i++) {

        $street = $faker->streetName;
        //check if $street has ' and replace it with \'
        if (str_contains($street, "'")) {
            $street = str_replace("'", "\'", $street);
        }
        $city = $faker->city;
        //check if $city has ' and replace it with \'
        if (str_contains($city, "'")) {
            $city = str_replace("'", "\'", $city);
        }
        $dbh->query("
                INSERT INTO addresses (street, city)
                VALUES (
                            '{$street}',
                            '{$city}'
                        )
        ");
    }
}

if (!empty($_POST['users_amount'])) {
    $usersAmount = $_POST['users_amount'];
    $addressesIds = $dbh->query("SELECT id FROM addresses")->fetchAll(PDO::FETCH_COLUMN);

    for ($i = 0; $i <= $usersAmount; $i++) {
        $key = array_rand($addressesIds);
        $addressesId = $addressesIds[$key];
        $username = $faker->userName;
        $password = json_encode($faker->password);
        //check if $street has ' and replace it with \' for all matches
        if (str_contains($password, "'")) {
            $password = str_replace("'", "\'", $password);
        }
        $email = $faker->unique()->email;
        $age = $faker->numberBetween(18, 100);
        $dbh->query("
                INSERT INTO users (address_id, username, password, email, age)
                VALUES ('{$addressesId}', '{$username}', '{$password}', '{$email}', '{$age}')
        ");
    }
}

if (!empty($_POST['categories_amount'])) {
    $categoryAmount = $_POST['categories_amount'];
    for ($i = 0; $i <= $categoryAmount; $i++) {
        $categoryName = $faker->word;
        if (str_contains($categoryName, "'")) {
            $categoryName = str_replace("'", "\'", $categoryName);
        }
        $dbh->query("
                INSERT INTO categories (`name`)
                VALUES ('{$categoryName}')
        ");
    }
}

if (!empty($_POST['posts_amount'])) {
    $postAmount = $_POST['posts_amount'];
    $usersIds = $dbh->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);
    $categoryIds = $dbh->query("SELECT id FROM categories")->fetchAll(PDO::FETCH_COLUMN);
    for ($i = 0; $i <= $postAmount; $i++) {
        $key = array_rand($usersIds);
        $userId = $usersIds[$key];
        $key = array_rand($categoryIds);
        $categoryId = $categoryIds[$key];
        $title = $faker->text(50);
        if (str_contains($title, "'")) {
            $title = str_replace("'", "\'", $title);
        }
        $body = $faker->realText(500);
        if (str_contains($body, "'")) {
            $body = str_replace("'", "\'", $body);
        }

        $dbh->query("
                INSERT INTO posts (user_id, category_id, title, body)
                VALUES ('{$userId}', '{$categoryId}', '{$title}', '{$body}')
        ");
    }
}

header('Location: ../index.php');
