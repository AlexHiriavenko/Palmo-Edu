-- Создаем таблицу пользователей (users)
CREATE TABLE users (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255),
    fio VARCHAR(255),
    area_id INT UNSIGNED
);

-- Создаем таблицу сертификатов (certificates)
CREATE TABLE certificates (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    number INT UNSIGNED,
    fio VARCHAR(255),
    year YEAR DEFAULT NULL,
    user_id INT UNSIGNED,
    series VARCHAR(10)
);

-- Создаем таблицу организаций (organizations)
CREATE TABLE organizations (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    count_students INT UNSIGNED
);

-- Создаем таблицу практики (practice)
CREATE TABLE practice (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    practice_id INT UNSIGNED,
    rating TINYINT UNSIGNED
);

-- Создаем таблицу новостей (news)
CREATE TABLE news (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    created_at DATE,
    category_id INT UNSIGNED
);

-- Создаем таблицу директоров (directors)
CREATE TABLE directors (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    phones VARCHAR(255),
    organization VARCHAR(255)
);

-- Создаем таблицу студентов (students)
CREATE TABLE students (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    surname VARCHAR(255),
    birthday DATE
);

-- Создаем таблицу публикаций (publishes)
CREATE TABLE publishes (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    publish_date DATE,
    body TEXT
);

-- Создаем таблицу жанров (genres)
CREATE TABLE genres (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

-- Создаем таблицу книг (books)
CREATE TABLE books (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    genre_id INT UNSIGNED
);

-- Создаем таблицу регионов (areas)
CREATE TABLE areas (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

-- Создаем таблицу категорий (categories)
CREATE TABLE organizations (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    count_students INT UNSIGNED,
    type_id INT UNSIGNED
);

-- Создаем таблицу городов (cities)
CREATE TABLE cities (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    area_id INT UNSIGNED
);

-- Создаем таблицу школ (schools)
CREATE TABLE schools (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    district_id INT UNSIGNED
);

-- Создаем таблицу округов (districts)
CREATE TABLE districts (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);
