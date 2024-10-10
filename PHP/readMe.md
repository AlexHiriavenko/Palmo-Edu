# PHP course

- Установите Docker, если он еще не установлен на вашем ПК.
- В командной строке, находясь в корневой директории проекта, выполните команду:<br>
  docker-compose up --build -d
- чтобы увидеть результаты выполнения PHP-скриптов откройте браузер и перейдите по адресу: <br>
  http://localhost:8000

### notes 

- для hw-5, чтобы сгенерировать файлы автозагрузки с помощью Composer внутри Docker-контейнера:
<br>
docker-compose exec php bash -c "cd /var/www/html/HW-5 && composer dump-autoload"