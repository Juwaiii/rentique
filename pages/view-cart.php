<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to view your cart.');
}

$user_id = $_SESSION['user_id'];
$back_url = $_SERVER['HTTP_REFERER'] ?? 'collections.php';

$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart - Rentique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9f6ef;
      font-family: 'Helvetica Neue', sans-serif;
      color: #3a2f2f;
    }
    .container {
      max-width: 800px;
      margin: auto;
      padding-top: 40px;
    }
    h2 {
      font-weight: 500;
      margin-bottom: 30px;
    }
    .btn-pay {
      background-color: #a38f7c;
      border: none;
    }
    .btn-pay:hover {
      background-color: #8a7863;
    }
    .btn-back {
      background-color: #6c757d;
      border: none;
    }
    .btn-back:hover {
      background-color: #5a6268;
    }
    .btn-delete {
      color: #dc3545;
      background: none;
      border: none;
      font-size: 16px;
    }
    .btn-delete:hover {
      color: #a71d2a;
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Your Boutique Cart</h2>

  <?php if (count($cart_items) > 0): ?>
    <div class="table-responsive mb-4">
      <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-light">
          <tr>
            <th>Item Name</th>
            <th>Price (RM)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart_items as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['item_name']) ?></td>
              <td><?= number_format($item['price'], 2) ?></td>
              <td>
                <form method="POST" action="delete.php" onsubmit="return confirm('Remove this item?');">
                  <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                  <button type="submit" class="btn-delete" title="Remove Item">🗑</button>
                </form>
              </td>
              <?php $total += $item['price']; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot class="table-light">
          <tr>
            <th>Total</th>
            <th colspan="2">RM <?= number_format($total, 2) ?></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="d-flex justify-content-between">
      <a href="<?= htmlspecialchars($back_url) ?>" class="btn btn-back">← Back</a>
      <form action="checkout.php" method="POST" class="d-inline">
        <input type="hidden" name="total" value="<?= $total ?>">
        <button class="btn btn-pay text-white">Proceed to Payment</button>
      </form>
    </div>
  <?php else: ?>
    <div class="alert alert-info">
      Your cart is currently empty. <a href="collections.php" class="alert-link">Start browsing collections →</a>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
