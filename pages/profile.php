<?php
session_start();
require_once '../db.php'; // adjust path to your DB connection file

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    header("Location: ../index.php");
    exit();
}

// Update logic
$success = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $address = $_POST["address"] ?? '';

    $stmt = $pdo->prepare("UPDATE users SET email = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->execute([$email, $phone, $address, $userId]);

    $success = true;
}

// Get current user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile - Rentique</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
  <style>
    :root {
      --primary: #d8c1a8;
      --secondary: #3a2f2f;
      --light: #f9f6ef;
      --accent: #a38f7c;
      --white: #ffffff;
    }

    body {
      background-color: var(--light);
      font-family: 'Helvetica Neue', sans-serif;
    }

    .profile-container {
      max-width: 700px;
      margin: 60px auto;
      padding: 40px;
      background-color: var(--white);
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .form-label {
      font-weight: 500;
      color: var(--secondary);
      margin-top: 15px;
    }

    .form-control {
      border-radius: 6px;
    }

    .btn-save, .btn-back {
      background-color: var(--secondary);
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 6px;
      font-weight: 500;
      margin-top: 25px;
      transition: 0.3s;
      margin-right: 10px;
    }

    .btn-save:hover, .btn-back:hover {
      background-color: var(--accent);
    }

    .alert-success {
      background-color: #dff0d8;
      color: #3c763d;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 20px;
      border: 1px solid #d0e9c6;
    }
  </style>
</head>
<body>

<div class="profile-container">
  <h3 class="text-center mb-4" style="color: var(--secondary);">Edit Profile</h3>

  <?php if ($success): ?>
    <div class="alert-success text-center">Profile updated successfully!</div>
  <?php endif; ?>

  <form method="POST" action="">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label class="form-label">Phone Number</label>
    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">

    <label class="form-label">Address</label>
    <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>

    <div class="text-center">
      <button type="submit" class="btn-save">Save Changes</button>
      <a href="account.php" class="btn-back">Back</a>
    </div>
  </form>
</div>

</body>
</html>
