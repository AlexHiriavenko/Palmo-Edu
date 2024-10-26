<?php

namespace Palmo\Controller;

use Palmo\Database\Db;
use Palmo\Service\AuthService;

class AuthController extends BaseController
{
    private AuthService $service;
    private array $actions = ['login', 'signup', 'logout'];  // Допустимые действия

    public function __construct()
    {
        $this->db = new Db;
        $this->service = new AuthService($this->db);
    }

    public function handleRequest(): void
    {
        // Проверяем значение `action` в $_POST
        $action = $_POST['action'] ?? '';

        if (in_array($action, $this->actions)) {
            $this->service->$action();  // Вызов соответствующего метода AuthService
            echo $_POST['action']; // 
        } else {
            // Обработка неизвестного действия
            echo $_POST['action'];
            echo "Error: Unrecognized action";
            http_response_code(400);
            exit;
        }
    }
}
