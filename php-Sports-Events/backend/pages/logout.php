<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Logging out...</title>
</head>

<body>
  <form id="logoutForm" action="/controller/auth.php" method="POST">
    <input type="hidden" name="action" value="logout">
  </form>
  <script>
    // Автоматически отправляет форму при загрузке страницы
    document.getElementById('logoutForm').submit();
  </script>
</body>

</html>