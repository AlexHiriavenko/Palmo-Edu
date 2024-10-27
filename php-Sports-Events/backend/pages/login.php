<?php
session_start();
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
  <title>Login</title>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
  <form method="post" action="/controller/auth.php" class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>

    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Enter email</label>
      <input type="email" id="email" name="email"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        value="<?php echo $_SESSION['email'] ?? ''; ?>">
    </div>
    <?php unset($_SESSION['email']); ?>

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
    <input type="hidden" name="action" value="login">

    <div class="flex items-center justify-between">
      <input type="submit" value="Log In"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer">
    </div>

    <div class="my-6">
      <label for="rememberMe" class="inline-flex items-center">
        <input type="checkbox" id="rememberMe" name="rememberMe" class="form-checkbox h-4 w-4 text-indigo-600">
        <span class="ml-2 text-gray-700 text-sm">Remember me</span>
      </label>
    </div>

    <p class="text-center text-gray-600 mt-6">
      У вас еще нет аккаунта?
      <a href="/signup.php" class="text-blue-500 hover:text-blue-700 font-bold">Sign up</a>
    </p>
  </form>
</body>

</html>