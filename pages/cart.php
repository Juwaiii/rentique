<?php
session_start();
require_once '../db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to add to cart.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $item_name = $_POST['item_name'] ?? '';
    $price = $_POST['price'] ?? 0;

    if ($item_name && $price > 0) {
        try {
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, item_name, price) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $item_name, $price]);

            // Update cart count
            $countStmt = $pdo->prepare("SELECT COUNT(*) FROM cart WHERE user_id = ?");
            $countStmt->execute([$user_id]);
            $_SESSION['cart_count'] = $countStmt->fetchColumn();

            header("Location: view-cart.php");
            exit();
        } catch (PDOException $e) {
            echo "Error adding to cart: " . $e->getMessage();
        }
    } else {
        echo "Invalid item or price.";
    }
} else {
    echo "Invalid request.";
}
