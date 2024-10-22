# PHP-Beginning

## Для первого запуска проекта выполните (см ниже) Project setup .

### Project Setup

1. cd php-Sports-Events/Docker
2. Setup .env file like as .env.example file:

```
  cp .env.example .env
```

3. Setup config.ini in backend folder if you needed.
4. execute command:

```
docker-compose build && \
docker-compose up -d && \
docker-compose run app composer install && \
docker-compose exec db mysql -u root -p123 -e "exit" || \
(docker-compose down && docker-compose up -d)

```
5. зайти на localhost:88

6. если подключения к db не произошло (Host 'xxx.x.x.x' is not allowed to connect to this MySQL server ) <br>
в командной строке выполнить команды по очереди. <br>
в случае ошибки при "ALTER USER 'root'@'%' IDENTIFIED BY '123';" выполнить ее еще раз повторно;

```
docker-compose exec db mysql -u root || docker-compose exec db mysql -u root -p123
UPDATE mysql.user SET host = '%' WHERE user = 'root' AND host = 'localhost';
ALTER USER 'root'@'%' IDENTIFIED BY '123';
ALTER USER 'root'@'%' IDENTIFIED BY '123';
CREATE DATABASE sports_events CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```
<br> в браузере обновить страницу localhost:88 пару раз;

6. после всех выше указанных шагов проект должен запуститься корректно



### Rebuild Light:

```
docker-compose down && \
docker-compose up -d
```

### Rebuild Full: полный Хард Резет и установа заново (!!! может затронуть другие контейнеры).

```
docker-compose down --volumes --rmi all --remove-orphans && \
docker images -q | xargs -r docker rmi && \
docker volume prune -f && \
docker builder prune -f && \
docker-compose build && \
docker-compose up -d && \
docker-compose exec app composer install && \
docker-compose exec db mysql -u root -p123 -e "exit" || \
(docker-compose down && docker-compose up -d)
```

### для обновления namespaces:

docker-compose run app composer dump-autoload

