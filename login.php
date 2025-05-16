<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Login</h1>
  <form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
    <p>don't have account <a href="register.php">Register</a></p>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $result = $conn->query("SELECT * FROM users WHERE email='$email'");
      $user = $result->fetch_assoc();

      if ($user && password_verify($password, $user['password'])) {
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['full_name'] = $user['full_name'];
          header("Location: index.php");
      } else {
          echo "<p>Invalid login.</p>";
      }
  }
  ?>
</body>
</html>
