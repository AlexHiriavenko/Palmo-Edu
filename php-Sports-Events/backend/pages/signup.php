<?php
session_start();
require '../vendor/autoload.php';

use Palmo\Database\Db;
use Palmo\Service\AuthService;

$db = new Db();
$authService = new AuthService($db);

$user = $authService->authenticateUser();
$isLoggedIn = $user && $user->getId();

if ($isLoggedIn) {
  header("Location: /index.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./public/imgs/football.ico">
  <link rel="stylesheet" href="./public/styles/reset.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/public/styles/styles.css">
  <title>Sign Up</title>
</head>

<body>
  <?php include '../views/app_header.php'; ?>
  <main class="app-main views flex items-center justify-center h-screen">
    <form method="post" action="/runScripts/runAuth.php" class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign Up</h2>

      <!-- Поле для имени -->
      <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Enter your name</label>
        <input type="text" id="name" name="name"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          value="<?php echo $_SESSION['name'] ?? ''; ?>">
      </div>
      <?php unset($_SESSION['name']); ?>

      <!-- Поле для email -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Enter email</label>
        <input type="email" id="email" name="email"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          value="<?php echo $_SESSION['email'] ?? ''; ?>">
      </div>
      <?php unset($_SESSION['email']); ?>

      <!-- Поле для пароля -->
      <div class="mb-4">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Enter password</label>
        <input type="password" id="password" name="password"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </div>

      <?php
      if (isset($_SESSION['errors'])) {
        echo '<p class="text-red-500 text-xs italic mb-4">' . $_SESSION['errors'] . '</p>';
        unset($_SESSION['errors']);
      }
      ?>

      <!-- Скрытое поле для явного указания значения для $_POST['action'] -->
      <input type="hidden" name="action" value="signup">

      <div class="flex items-center justify-between">
        <input type="submit" value="Sign Up"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer">
      </div>

      <!-- Ссылка на логин -->
      <p class="text-center text-gray-600 mt-6">
        Уже есть аккаунт?
        <a href="/login.php" class="text-blue-500 hover:text-blue-700 font-bold">Login</a>
      </p>
    </form>
  </main>
</body>

</html>