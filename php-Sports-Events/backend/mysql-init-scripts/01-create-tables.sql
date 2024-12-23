START TRANSACTION;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    role ENUM('admin', 'user') NOT NULL
);

CREATE TABLE `user_tokens` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `token` VARCHAR(64) NOT NULL,
    `expires_at` DATETIME NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS sportEvents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    location VARCHAR(255),
    dateTime DATETIME NOT NULL,
    price DECIMAL(10, 2)
);

CREATE TABLE IF NOT EXISTS favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    eventId INT,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (eventId) REFERENCES sportEvents(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS bookedEvents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    eventId INT,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (eventId) REFERENCES sportEvents(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS occupiedSeats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eventId INT,
    seatNumber INT,
    userId INT,  
    FOREIGN KEY (eventId) REFERENCES sportEvents(id) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE (eventId, seatNumber)
);

COMMIT;