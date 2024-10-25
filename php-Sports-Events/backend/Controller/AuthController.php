<?php

namespace Palmo\Controller;

use Palmo\Service\AuthService;

class AuthController extends BaseController
{
    private AuthService $service;
    private array $actions = ['login', 'signup', 'logout'];  // Допустимые действия

    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function handleRequest(): void
    {
        // Проверяем значение `action` в $_POST
        $action = $_POST['action'] ?? '';

        if (in_array($action, $this->actions)) {
            $this->service->$action();  // Вызов соответствующего метода AuthService
        } else {
            // Обработка неизвестного действия
            echo "Error: Unrecognized action";
            http_response_code(400);  // Возвращаем HTTP-код ошибки, например, 400 Bad Request
            echo http_response_code();
            exit;
        }
    }
}