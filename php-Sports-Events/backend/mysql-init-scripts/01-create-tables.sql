CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    role ENUM('admin', 'user') NOT NULL
);

CREATE TABLE sportEvents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    location VARCHAR(255),
    dateTime DATETIME NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    eventId VARCHAR(50),
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (eventId) REFERENCES sportEvents(id) ON DELETE CASCADE
);

CREATE TABLE bookedEvents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    eventId VARCHAR(50),
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (eventId) REFERENCES sportEvents(id) ON DELETE CASCADE
);

CREATE TABLE occupiedSeats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eventId VARCHAR(50),
    seatNumber INT,
    userId INT,  
    FOREIGN KEY (eventId) REFERENCES sportEvents(id) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE (eventId, seatNumber)
);