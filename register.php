<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="style.css?v=1">
</head>
<body>
  <h1>Create Account</h1>
  <form method="POST">
    <input type="text" name="full_name" placeholder="Full name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button class="register-btn" type="submit" name="action" value="check">Register</button>
    <p>Already have an account <a href="login.php">Login</a></p>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $full_name = $_POST['full_name'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
      if ($check->num_rows > 0) {
          echo "Email already exists.";
      } else {
          $conn->query("INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')");
          header("Location: login.php");
          exit;
      }
  }
  ?>
</body>
</html>
