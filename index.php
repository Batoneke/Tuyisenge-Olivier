<!DOCTYPE html>
<html>
<head>
  <title>Simple Bank</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Tuyisenge Olivier</h1>

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
</body>
</html>
