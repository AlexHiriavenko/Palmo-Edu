<?php

namespace Palmo\Interface;

interface RememberMeInterface
{
  public function generateToken(): string;

  public function saveToken(int $userId, string $token): void;

  public function validateToken(string $token): bool;

  public function removeToken(int $userId): void;

  public function updateToken(int $userId, string $token): void;
}
