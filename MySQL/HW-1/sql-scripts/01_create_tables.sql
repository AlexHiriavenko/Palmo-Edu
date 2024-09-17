-- Create table users 
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(50) NOT NULL,
  address VARCHAR(255),
  birth_date DATE,
  role VARCHAR(50)
);

-- Create table regions
CREATE TABLE IF NOT EXISTS regions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  region_name VARCHAR(100) NOT NULL
);

-- Create table news
CREATE TABLE IF NOT EXISTS news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT,
  image_url VARCHAR(255),
  author VARCHAR(50),
  publication_date DATE,
  is_active BOOLEAN DEFAULT TRUE
);