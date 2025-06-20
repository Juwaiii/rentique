<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $user_id = $_SESSION['user_id'];

    // Delete item that belongs to the user
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $user_id]);

    // Update cart count
    $count = $pdo->prepare("SELECT SUM(quantity) FROM cart WHERE user_id = ?");
    $count->execute([$user_id]);
    $_SESSION['cart_count'] = $count->fetchColumn() ?? 0;

    header("Location: view-cart.php");
    exit();
} else {
    die("Invalid request.");
}
