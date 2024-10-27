<?php

namespace Palmo\Service;

use Palmo\Service\Validator\Validator;
use Palmo\Models\User\UserModel;
use Palmo\Database\Db;

require "../vendor/autoload.php";

class AuthService
{
  private Db $db;
  private string $email;
  private string $password;
  private string $name;

  public function __construct(Db $db)
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->db = $db;
  }

  private function redirectWithError(string $message, string $location): void
  {
    $_SESSION['errors'] = $message;
    header("Location: $location");
    exit();
  }

  private function initializeCredentials(): void
  {
    $this->email = $_POST['email'] ?? '';
    $this->password = $_POST['password'] ?? '';
    $this->name = $_POST['name'] ?? '';

    $_SESSION['email'] = $this->email;
    $_SESSION['password'] = $this->password;
    $_SESSION['name'] = $this->name;
  }

  public function login(): void
  {
    $this->initializeCredentials();

    // Валидация email
    $isValidEmail = (new Validator('email', $this->email))->validate();
    if (!$isValidEmail) {
      $this->redirectWithError("Incorrect email format", "/login.php");
      return;
    }

    // Поиск юзера в бд
    $userModel = new UserModel($this->db);
    $user = $userModel->findByEmail($this->email);

    if ($user == null) {
      $this->redirectWithError("User with email $this->email not found", "/login.php");
      return;
    }

    // Проверка пароля
    $isPasswordCorrect = password_verify($this->password, $user->getPassword());
    if (!$isPasswordCorrect) {
      $this->redirectWithError("Incorrect password", "/login.php");
      return;
    }

    session_unset();
    $_SESSION['userId'] = $user->getId();

    if (isset($_POST['rememberMe'])) {
      echo "remember";
    };
    header("Location: /index.php");
  }

  public function signup(): void
  {
    $this->initializeCredentials();

    // Валидация name
    $isValidName = (new Validator('name', $this->name))->validate();
    if (!$isValidName) {
      $this->redirectWithError("Name too short", "/signup.php");
      return;
    }

    // Валидация email
    $isValidEmail = (new Validator('email', $this->email))->validate();
    if (!$isValidEmail) {
      $this->redirectWithError("Incorrect email format", "/signup.php");
      return;
    }

    // Валидация password
    $isValidPassword = (new Validator('password', $this->password))->validate();
    if (!$isValidPassword) {
      $this->redirectWithError("Password too short", "/signup.php");
      return;
    }

    // Проверка существования пользователя с таким email
    $userModel = new UserModel($this->db);
    if ($userModel->findByEmail($this->email) !== null) {
      $this->redirectWithError("User with this email already exists", "/signup.php");
      return;
    }

    // Создание нового пользователя
    $isCreated = $userModel->createUser($this->name, $this->email, $this->password);

    if (!$isCreated) {
      $this->redirectWithError("Failed to create user. Please try later.", "/signup.php");
      return;
    }

    // Сообщение об успешной регистрации
    echo "signup";
  }

  public function logout(): void
  {
    session_destroy();
    header("Location: /index.php");
    exit();
  }
}
