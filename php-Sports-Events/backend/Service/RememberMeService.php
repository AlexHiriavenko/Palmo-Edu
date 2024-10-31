<?php

namespace Palmo\Service;

use Palmo\Interface\RememberMeInterface;
use Palmo\Repository\BaseRepository;

class RememberMeService implements RememberMeInterface
{
  private BaseRepository $baseRepository;

  public function __construct(BaseRepository $baseRepository)
  {
    $this->baseRepository = $baseRepository;
  }

  public function generateToken(): string
  {
    return bin2hex(random_bytes(32));
  }

  public function findToken(int $userId): ?array
  {
    $token = $this->baseRepository->readFiltered('user_tokens', ['user_id' => $userId], 1);
    return !empty($token) ? $token : null;
  }

  public function getUserId(string $token): ?int
  {
    // Ищем запись с соответствующим токеном
    $result = $this->baseRepository->readFiltered('user_tokens', ['token' => $token], 1);

    // Если токен найден, возвращаем user_id
    if (!empty($result)) {
      return $result[0]['user_id'];
    }

    // Если токен не найден, возвращаем null
    return null;
  }


  public function saveToken(int $userId, string $token): void
  {
    $expiresAt = time() + (60 * 60 * 24 * 7);  // 7 дней
    $data = [
      'user_id' => $userId,
      'token' => $token,
      'expires_at' => date('Y-m-d H:i:s', $expiresAt)
    ];

    // Проверка наличия токена
    $existingToken = $this->findToken($userId);

    if (!empty($existingToken)) {
      $tokenId = $existingToken[0]['id'];
      $this->baseRepository->update('user_tokens', $tokenId, $data);
    } else {
      $this->baseRepository->create('user_tokens', $data);
    }

    // Устанавливаем cookie
    setcookie('rememberMe', $token, [
      'expires' => $expiresAt,
      'path' => '/',
      'httponly' => true,
      'secure' => false
    ]);
  }

  public function validateToken(string $token): bool
  {
    $result = $this->baseRepository->readFiltered('user_tokens', ['token' => $token], 1);

    if (!empty($result)) {
      $userId = $result[0]['user_id'];
      $expiresAt = strtotime($result[0]['expires_at']);

      if ($expiresAt - time() < 60 * 60 * 24) {
        $this->updateToken($userId, $token);
      }

      return true;
    }

    return false;
  }

  public function setToken(int $userId): void
  {
    $token = $this->generateToken();
    $this->saveToken($userId, $token);
  }

  public function removeToken(int $userId): void
  {
    $token = $this->findToken($userId);
    if (!empty($token)) {
      $tokenId = $token[0]['id'];
      $this->baseRepository->delete('user_tokens', $tokenId);
    }

    if (isset($_COOKIE['rememberMe'])) {
      setcookie('rememberMe', '', time() - 3600, '/', '', false, true);
      unset($_COOKIE['rememberMe']);
    }
  }

  public function updateToken(int $userId, string $token): void
  {
    $tokenId = $this->findToken($userId)[0]['id'] ?? null;
    if ($tokenId) {
      $expiresAt = time() + (60 * 60 * 24 * 7);  // Продление на 7 дней
      $data = ['expires_at' => date('Y-m-d H:i:s', $expiresAt)];
      $this->baseRepository->update('user_tokens', $tokenId, $data);
    }
  }
}
