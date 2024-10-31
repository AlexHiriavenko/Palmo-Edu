<?php

namespace Palmo\Controller;

use Palmo\Database\Db;
use Palmo\Service\AuthService;

class AuthController extends BaseController
{
    private AuthService $service;
    private array $actions = ['login', 'signup', 'logout'];

    public function __construct()
    {
        $this->db = new Db;
        $this->service = new AuthService($this->db);
    }

    public function handleRequest(): void
    {
        $action = $_POST['action'] ?? '';

        if (in_array($action, $this->actions)) {
            $this->service->$action();  // Вызов соответствующего метода AuthService
        } else {
            echo "Error: Unrecognized action {$_POST['action']}";
            http_response_code(400);
            exit;
        }
    }
}
