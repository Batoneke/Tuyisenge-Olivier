<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Simple Bank</title>
  <link rel="stylesheet" href="style.css?v=1">
</head>
<body>
  <h1>Tuyisenge Olivier</h1>
  <h1><?php echo $_SESSION['full_name']; ?></h1>

  <form action="bank.php" method="POST">
    <h2>Deposit money (Rwf)</h2>
    <input type="number" name="deposit" placeholder="Enter amount to deposit">
    <button class="blue-btn" type="submit" name="action" value="deposit">Deposit</button>

    <h2>Withdraw money (Rwf)</h2>
    <input type="number" name="withdraw" placeholder="Enter amount to withdraw">
    <button class="yellow-btn" type="submit" name="action" value="withdraw">Withdraw</button>

    <h2>Check balance</h2>
    <button class="check-btn" type="submit" name="action" value="check">Check Balance</button>
  </form>

  <br><a href="logout.php">Logout</a>
</body>
</html>
