<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to proceed to checkout.');
}

$user_id = $_SESSION['user_id'];
$total = $_POST['total'] ?? 0;

if ($total <= 0) {
    die('Invalid total amount.');
}

try {
    // 1. Insert order into `orders` table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->execute([$user_id, $total]);

    // 2. Clear user's cart
    $clear = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
    $clear->execute([$user_id]);

    // 3. Reset cart count
    $_SESSION['cart_count'] = 0;

    // 4. Show success message
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <title>Order Success</title>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
      <div class='container mt-5'>
        <div class='alert alert-success'>
          <h4 class='alert-heading'>Payment Successful!</h4>
          <p>Your order of <strong>RM " . number_format($total, 2) . "</strong> has been placed successfully.</p>
          <hr>
          <a href='collections.php' class='btn btn-primary'>Continue Shopping</a>
        </div>
      </div>
    </body>
    </html>";
} catch (PDOException $e) {
    echo "Error processing checkout: " . $e->getMessage();
}
