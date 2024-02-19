<?php

function getTransactionHistory($user_id)
{
    require "../src/DBconnect.php";

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $stmt = $conn->prepare("SELECT * FROM transactions WHERE user_id = :user_id ORDER BY date DESC");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;

    return $result;
}


$user_id = 123; // Replace with actual user ID

$transactions = getTransactionHistory($user_id);

echo "<table>";
echo "<tr><th>Date</th><th>Amount</th><th>Description</th></tr>";
foreach ($transactions as $transaction) {
    echo "<tr>";
    echo "<td>" . $transaction['date'] . "</td>";
    echo "<td>" . $transaction['amount'] . "</td>";
    echo "<td>" . $transaction['description'] . "</td>";
    echo "</tr>";
}
echo "</table>";





