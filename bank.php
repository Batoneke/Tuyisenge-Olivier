<?php
session_start();
include 'connect.php';

$user_id = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'];


$check = $conn->query("SELECT id FROM accounts WHERE id = $user_id");
if ($check->num_rows == 0) {
    $conn->query("INSERT INTO accounts (id, full_name, balance) VALUES ($user_id, '$full_name', 0)");
}

$action = $_POST['action'] ?? '';

if ($action == 'deposit') {
    $amount = (int)$_POST['deposit'];
    $conn->query("UPDATE accounts SET balance = balance + $amount WHERE id = $user_id");
    $conn->query("INSERT INTO transactions (account_id, type, amount) VALUES ($user_id, 'deposit', $amount)");

    $balance = $conn->query("SELECT balance FROM accounts WHERE id = $user_id")->fetch_assoc();
    echo "Deposited Rwf $amount successfully.<br>New balance: Rwf " . $balance['balance'];

} elseif ($action == 'withdraw') {
    $amount = (int)$_POST['withdraw'];
    $balance = $conn->query("SELECT balance FROM accounts WHERE id = $user_id")->fetch_assoc();

    if ($balance['balance'] >= $amount) {
        $conn->query("UPDATE accounts SET balance = balance - $amount WHERE id = $user_id");
        $conn->query("INSERT INTO transactions (account_id, type, amount) VALUES ($user_id, 'withdraw', $amount)");

        $balance = $conn->query("SELECT balance FROM accounts WHERE id = $user_id")->fetch_assoc();
        echo "Withdrew Rwf $amount successfully.<br>New balance: Rwf " . $balance['balance'];
    } else {
        echo "Insufficient balance!";
    }

} elseif ($action == 'check') {
    $balance = $conn->query("SELECT balance FROM accounts WHERE id = $user_id")->fetch_assoc();
    echo "Your current balance is Rwf " . $balance['balance'];

    echo "<br><h3>Transaction History</h3>";
    $result = $conn->query("SELECT * FROM transactions WHERE account_id = $user_id ORDER BY transaction_date DESC");
    echo "<ul>";
    while ($t = $result->fetch_assoc()) {
        echo "<li>" . ucfirst($t['type']) . " of Rwf " . $t['amount'] . " on " . $t['transaction_date'] . "</li>";
    }
    echo "</ul>";

} else {
    echo "Invalid action.";
}

echo "<br><br><a href='index.php'>Go back</a>";
$conn->close();
?>
