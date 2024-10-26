<?php

namespace Palmo\Models\User;

use Palmo\Database\CrudBaseModel;
use Palmo\Database\Db;
use Palmo\Models\User\User;
use PDOException;

class UserModel extends CrudBaseModel
{
  protected string $table = 'users';

  public function __construct(Db $db)
  {
    parent::__construct($db);
  }

  public function findById(int $id): User|null
  {
    $user = $this->readById($this->table, $id);

    if (empty($user)) {
      return null;
    }

    return new User(
      $user['id'],
      $user['name'],
      $user['email'],
      $user['password'],
      $user['role']
    );
  }

  public function findByEmail(string $email): User|null
  {
    // Используем readFiltered с фильтром по email
    $user = $this->readFiltered($this->table, ['email' => $email], limit: 1)[0] ?? null;

    if (empty($user)) {
      return null;
    }

    return new User(
      $user['id'],
      $user['name'],
      $user['email'],
      $user['password'],
      $user['role']
    );
  }

  public function createUser(string $name, string $email, string $password, string $role = 'user'): bool
  {
    try {

      $newUser = [
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => $role
      ];

      return $this->create($this->table, $newUser);
    } catch (PDOException $e) {
      $this->handleError($e);
      return false;
    }
  }
}
