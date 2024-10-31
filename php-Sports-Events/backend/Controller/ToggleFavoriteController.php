<?php

namespace Palmo\Controller;

use Palmo\Database\Db;
use Palmo\Repository\FavoritesRepository;

class ToggleFavoriteController extends BaseController
{
    private FavoritesRepository $favoritesRepository;

    public function __construct()
    {
        $this->db = new Db();
        
        session_start();

        if (!isset($_SESSION['userId'])) {
            $this->sendJsonResponse(['success' => false, 'message' => 'Требуется авторизация']);
            exit;
        }

        $this->favoritesRepository = new FavoritesRepository($this->db);
    }

    public function handleRequest()
    {
        $userId = $_SESSION['userId'];
        $data = json_decode(file_get_contents('php://input'), true);
        $eventId = $data['eventId'] ?? null;

        if ($eventId) {
            $success = $this->favoritesRepository->toggleFavorite($userId, (int)$eventId);
            $this->sendJsonResponse(['success' => $success]);
        } else {
            $this->sendJsonResponse(['success' => false, 'message' => 'Неверный идентификатор события']);
        }
    }

    private function sendJsonResponse(array $response): void
    {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
