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
