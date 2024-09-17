--  Отключает проверки внешних ключей.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS regions;
DROP TABLE IF EXISTS news;

SET FOREIGN_KEY_CHECKS = 1;
