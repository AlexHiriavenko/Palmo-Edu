# Используем образ PHP с встроенным сервером
FROM php:8.0-cli

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем файлы проекта в контейнер
COPY . /var/www/html

# Открываем порт для встроенного PHP-сервера
EXPOSE 8000

# Запуск встроенного PHP-сервера на порту 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]