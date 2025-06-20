<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    die('Please log in to view your rentals.');
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

$total = 0;
$active_count = 0;
foreach ($cart_items as $item) {
    $active_count += $item['quantity'];
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Rentals - Rentique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9f6ef;
      font-family: 'Helvetica Neue', sans-serif;
      color: #3a2f2f;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      padding-top: 40px;
    }

    .card-grid {
      display: flex;
      gap: 20px;
      margin-bottom: 40px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .rental-card {
      flex: 1;
      min-width: 300px;
      background: white;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
      text-align: center;
    }

    .rental-card i {
      font-size: 32px;
      margin-bottom: 10px;
      color: #3a2f2f;
    }

    .rental-card h5 {
      font-weight: 600;
      margin-bottom: 5px;
    }

    .table th, .table td {
      vertical-align: middle;
    }

    .btn-pay {
      background-color: #a38f7c;
      border: none;
    }

    .btn-pay:hover {
      background-color: #8b7863;
    }

    .section-title {
      font-size: 24px;
      font-weight: 500;
      margin-bottom: 20px;
    }
  </style>
  <script src="https://kit.fontawesome.com/4d7b52ea12.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
  <!-- Overview Cards -->
  <div class="card-grid">
    <div class="rental-card">
      <i class="fas fa-shopping-bag"></i>
      <h5>Active Rentals</h5>
      <p>You currently have <?= $active_count ?> item(s) in your cart.</p>
    </div>
    <div class="rental-card">
      <i class="fas fa-clock"></i>
      <h5>Rental History</h5>
      <p>View all your past orders and returns.</p>
    </div>
  </div>

  <!-- Cart Table -->
  <h4 class="section-title">Items in Your Cart</h4>
  <?php if (!empty($cart_items)): ?>
    <div class="table-responsive mb-4">
      <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-light">
          <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price (RM)</th>
            <th>Subtotal (RM)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart_items as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['item_name']) ?></td>
              <td><?= $item['quantity'] ?></td>
              <td><?= number_format($item['price'], 2) ?></td>
              <td><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot class="table-light">
          <tr>
            <th colspan="3" class="text-end">Total</th>
            <th>RM <?= number_format($total, 2) ?></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <form action="checkout.php" method="POST" class="text-end">
      <input type="hidden" name="total" value="<?= $total ?>">
      <button type="submit" class="btn btn-pay btn-lg text-white">Proceed to Payment</button>
    </form>
  <?php else: ?>
    <div class="alert alert-info">You have no items in your boutique bag. <a href="collections.php" class="alert-link">Start browsing collections →</a></div>
  <?php endif; ?>
</div>

</body>
</html>
