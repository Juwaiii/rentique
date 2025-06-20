<?php
session_start();
require_once 'db.php';

// Handle Register
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->execute([$email]);
  if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = "Email already registered.";
  } else {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);
    $_SESSION['success'] = "Account created successfully!";
  }
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && !isset($_POST['name'])) {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header("Location: pages/account.php");
    exit;
  } else {
    $_SESSION['error'] = "Invalid login credentials.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rentique - Fashion Rental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .top-header { background-color: #fefcf7; padding: 20px 0; text-align: center; position: relative; }
    .brand-title { font-family: 'Helvetica Neue', sans-serif; font-size: 48px; font-weight: 500; margin: 0; }
    .brand-subtitle { letter-spacing: 4px; font-size: 14px; }
    .nav-menu { background-color: #d8c1a8; padding: 10px 0; }
    .nav-menu a { color: #000; font-style: italic; margin: 0 15px; text-decoration: none; font-weight: 500; }
    .nav-icons { position: absolute; top: 30px; right: 30px; font-size: 20px; }
    .nav-icons a { color: #000; margin-left: 15px; }
    .hero-custom { display: flex; flex-wrap: wrap; min-height: 80vh; }
    .hero-text { flex: 1; background-color: #f8f6f0; display: flex; flex-direction: column; justify-content: center; padding: 50px; }
    .hero-text h1 { font-size: 3rem; font-weight: bold; }
    .hero-text p { font-size: 14px; letter-spacing: 2px; margin-top: 20px; }
    .hero-images { flex: 1; display: flex; flex-wrap: wrap; justify-content: center; align-items: center; background-color: #fff; }
    .hero-images img { max-width: 100%; height: auto; margin: 10px; object-fit: cover; }
    @media (max-width: 768px) {
      .hero-custom { flex-direction: column; }
      .hero-text { padding: 30px; text-align: center; }
    }
  </style>
</head>
<body>

<div class="top-header">
  <div class="container">
    <h1 class="brand-title">Rentique</h1>
    <div class="brand-subtitle">CLOTHING</div>
    <div class="nav-icons">
      <a href="pages/view-cart.php"><i class="bi bi-bag"></i></a>
      <a href="#" data-bs-toggle="modal" data-bs-target="#accountModal"><i class="bi bi-person"></i></a>
    </div>
  </div>
</div>

<div class="nav-menu text-center">
  <a href="#">Home</a>
  <a href="pages/collections.php">Collections</a>
  <a href="pages/rent-service.php">Rent Service</a>
  <?php if (isset($_SESSION['user_id'])): ?>
    <a href="pages/account.php">My Account</a>
  <?php else: ?>
    <a href="#" data-bs-toggle="modal" data-bs-target="#accountModal">My Account</a>
  <?php endif; ?>
  <a href="pages/about.php">About Us</a>
</div>

<section class="hero-custom">
  <div class="hero-text">
    <h1>Malaysia’s Go-To Fashion Rental for Every Occasion.</h1>
    <p>START RENTING NOW!</p>
  </div>
  <div class="hero-images">
    <img src="./images/model2.jpg" alt="Model 2">
  </div>
</section>

<!-- Account Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 p-3">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title w-100 text-center fw-bold">Welcome to Rentique</h5>
        <button type="button" class="btn-close me-2" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger text-center"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php elseif (isset($_SESSION['success'])): ?>
          <div class="alert alert-success text-center"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" id="loginForm" class="px-2">
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
              <input type="email" class="form-control" id="loginEmail" name="email" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input type="password" class="form-control" id="loginPassword" name="password" required>
            </div>
          </div>
          <button type="submit" class="btn btn-dark w-100 rounded-pill">Login</button>
          <p class="text-center mt-3">Don’t have an account? <a href="#" onclick="toggleForms('register')">Register here</a></p>
        </form>

        <!-- Register Form -->
        <form method="POST" id="registerForm" class="px-2" style="display: none;">
          <div class="mb-3">
            <label for="regName" class="form-label">Full Name</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control" id="regName" name="name" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="regEmail" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
              <input type="email" class="form-control" id="regEmail" name="email" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="regPassword" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input type="password" class="form-control" id="regPassword" name="password" required>
            </div>
          </div>
          <button type="submit" class="btn btn-dark w-100 rounded-pill">Register</button>
          <p class="text-center mt-3">Already have an account? <a href="#" onclick="toggleForms('login')">Login here</a></p>
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0">© 2025 Rentique. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleForms(form) {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    loginForm.style.display = form === 'register' ? 'none' : 'block';
    registerForm.style.display = form === 'register' ? 'block' : 'none';
  }
</script>
</body>
</html>
