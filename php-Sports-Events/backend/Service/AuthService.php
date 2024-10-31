<?php

namespace Palmo\Service;

use Palmo\Service\Validator\Validator;
use Palmo\Service\RememberMeService;
use Palmo\Repository\UserRepository;
use Palmo\Database\Db;
use Palmo\Database\CrudBaseModel;

// require "../vendor/autoload.php";

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
    $this->email = $_POST['email'];
    $this->password = $_POST['password'];
    $this->name = $_POST['name'] ?? '';

    $_SESSION['email'] = $this->email;
    $_SESSION['password'] = $this->password;
    $_SESSION['name'] = $this->name;
  }

  // выполняем аутентификацию юезра
  public function authenticateUser(): void
  {
    if (isset($_SESSION['userId'])) {
      $userRepository = new UserRepository($this->db);
      $user = $userRepository->findById($_SESSION['userId']);
      $_SESSION['name'] = $user->getName();
      $_SESSION['role'] = $user->getRole();
    }

    if (isset($_COOKIE['rememberMe']) && !isset($_SESSION['userId'])) {
      $crudModel = new CrudBaseModel($this->db);
      $rememberMeService = new RememberMeService($crudModel);
      $token = $_COOKIE['rememberMe'];

      if ($rememberMeService->validateToken($token)) {
        $userId = $rememberMeService->getUserId($token);

        if ($userId) {
          $_SESSION['userId'] = $userId;
          $userRepository = new UserRepository($this->db);
          $user = $userRepository->findById($userId);
          $_SESSION['name'] = $user->getName();
          $_SESSION['role'] = $user->getRole();
        }
      }
    }
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
    $userRepository = new UserRepository($this->db);
    $user = $userRepository->findByEmail($this->email);

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
    $_SESSION['name'] = $user->getName();
    $_SESSION['role'] = $user->getRole();

    // Логика "remember me"
    if (isset($_POST['rememberMe'])) {
      $crudModel = new CrudBaseModel($this->db);
      $rememberMeService = new RememberMeService($crudModel);

      // Устанавливаем токен
      $rememberMeService->setToken($user->getId());
    }

    header("Location: /index.php");
    exit();
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
    $userRepository = new UserRepository($this->db);
    if ($userRepository->findByEmail($this->email) !== null) {
      $this->redirectWithError("User with this email already exists", "/signup.php");
      return;
    }

    // Создание нового пользователя
    $isCreated = $userRepository->createUser($this->name, $this->email, $this->password);

    if (!$isCreated) {
      $this->redirectWithError("Failed to create user. Please try later.", "/signup.php");
      return;
    }

    header("Location: /login.php");
    exit();
  }

  public function logout(): void
  {
    // Удаляем токен из базы данных и куки
    if (isset($_SESSION['userId'])) {
      $crudModel = new CrudBaseModel($this->db);
      $rememberMeService = new RememberMeService($crudModel);
      $rememberMeService->removeToken($_SESSION['userId']);
    }

    session_destroy();

    header("Location: /index.php");
    exit();
  }
}
