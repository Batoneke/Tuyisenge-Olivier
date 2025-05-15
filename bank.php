<?php
include 'connect.php';

$account_id = 1;

// Create the account if not exists
$conn->query("INSERT IGNORE INTO accounts (id, full_name, balance) VALUES ($account_id, 'Tuyisenge Olivier', 0)");

$action = $_POST['action'] ?? '';

if ($action == 'deposit') {
    $amount = (int)$_POST['deposit'];
    $conn->query("UPDATE accounts SET balance = balance + $amount WHERE id = $account_id");
    $conn->query("INSERT INTO transactions (account_id, type, amount) VALUES ($account_id, 'deposit', $amount)");
    
    // Get updated balance
    $result = $conn->query("SELECT balance FROM accounts WHERE id = $account_id");
    $row = $result->fetch_assoc();
    echo "Deposited Rwf $amount successfully.<br>";
    echo "New balance: Rwf " . $row['balance'];

} elseif ($action == 'withdraw') {
    $amount = (int)$_POST['withdraw'];
    $result = $conn->query("SELECT balance FROM accounts WHERE id = $account_id");
    $row = $result->fetch_assoc();

    if ($row['balance'] >= $amount) {
        $conn->query("UPDATE accounts SET balance = balance - $amount WHERE id = $account_id");
        $conn->query("INSERT INTO transactions (account_id, type, amount) VALUES ($account_id, 'withdraw', $amount)");
        
        // Get updated balance
        $result = $conn->query("SELECT balance FROM accounts WHERE id = $account_id");
        $row = $result->fetch_assoc();
        echo "Withdrew Rwf $amount successfully.<br>";
        echo "New balance: Rwf " . $row['balance'];
    } else {
        echo "Insufficient balance!";
    }

} elseif ($action == 'check') {
    $result = $conn->query("SELECT balance FROM accounts WHERE id = $account_id");
    $row = $result->fetch_assoc();
    echo "Your current balance is Rwf " . $row['balance'];
    
    echo "<br><h3>Transaction History</h3>";
    $result = $conn->query("SELECT * FROM transactions WHERE account_id = $account_id ORDER BY transaction_date DESC");
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
