
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rentique - My Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Helvetica Neue', sans-serif;
      background-color: #f8f6f0;
    }
    .top-header {
      background-color: #fefcf7;
      padding: 20px 0;
      text-align: center;
      position: relative;
    }
    .brand-title {
      font-size: 36px;
      font-weight: 500;
      margin: 0;
    }
    .nav-menu {
      background-color: #d8c1a8;
      padding: 10px 0;
    }
    .nav-menu a {
      color: #000;
      font-style: italic;
      margin: 0 15px;
      text-decoration: none;
      font-weight: 500;
    }
    .dashboard-content {
      padding: 40px 20px;
    }
    .card-custom {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      background-color: #fff;
      padding: 30px;
    }
    .logout-btns {
      position: absolute;
      top: 30px;
      right: 30px;
    }
    .logout-btns a {
      margin-left: 10px;
    }
    @media (max-width: 768px) {
      .logout-btns {
        position: static;
        margin-top: 10px;
        text-align: center;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<div class="top-header">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="brand-title">Rentique</h1>
    <div class="logout-btns">
      <a href="../index.php" class="btn btn-outline-secondary me-2">Back to Home</a>
      <a href="../logout.php" class="btn btn-outline-dark">Logout</a>
    </div>
  </div>
</div>

<!-- Nav Menu -->
<div class="nav-menu text-center">
  <a href="account.php">Dashboard</a>
  <a href="collections.php">Browse Collection</a>
  <a href="my-rentals.php">My Rentals</a>
  <a href="profile.php">Profile</a>
</div>

<!-- Dashboard Content -->
<div class="container dashboard-content">
  <div class="text-center mb-4">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
    <p class="text-muted">Here’s your dashboard summary.</p>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card-custom text-center">
        <i class="bi bi-bag fs-1 mb-2"></i>
        <h5 class="fw-bold">Active Rentals</h5>
        <p>You currently have 2 items rented.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-custom text-center">
        <i class="bi bi-clock-history fs-1 mb-2"></i>
        <h5 class="fw-bold">Rental History</h5>
        <p>View all your past orders and returns.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-custom text-center">
        <i class="bi bi-person-circle fs-1 mb-2"></i>
        <h5 class="fw-bold">My Profile</h5>
        <p>Update your personal information.</p>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
  <p class="mb-0">© 2025 Rentique. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
