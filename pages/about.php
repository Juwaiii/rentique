<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Rentique</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Helvetica Neue', sans-serif;
      background-color: #fefcf7;
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
    .brand-subtitle {
      letter-spacing: 4px;
      font-size: 14px;
    }
    .nav-icons {
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 20px;
    }
    .nav-icons a {
      color: #000;
      margin-left: 15px;
      text-decoration: none;
    }
    .nav-menu {
      background-color: #d8c1a8;
      padding: 10px 0;
      text-align: center;
    }
    .nav-menu a {
      color: #000;
      font-style: italic;
      margin: 0 15px;
      text-decoration: none;
      font-weight: 500;
    }

    .about-section {
      background: url('../images/about-bg.jpg') no-repeat center center;
      background-size: cover;
      padding: 100px 20px;
      color: white;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .about-section::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }
    .about-section h2,
    .about-section p {
      position: relative;
      z-index: 1;
    }
    .about-section h2 {
      font-size: 48px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .about-section p {
      font-size: 18px;
      max-width: 800px;
      margin: 0 auto;
      line-height: 1.8;
    }

    .faq-section {
      background: url('../images/faq-bg.jpg') no-repeat center center;
      background-size: cover;
      padding: 100px 20px;
      color: white;
      text-align: center;
    }
    .faq-section h2 {
      font-size: 36px;
      margin-bottom: 30px;
      font-family: serif;
    }
    .accordion-button {
      background-color: transparent;
      color: white;
      font-weight: 500;
      border: none;
    }
    .accordion-item {
      background-color: transparent;
      border: none;
      border-bottom: 1px solid #fff;
    }
    .accordion-body {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
    }

    .confidence-section {
      background: url('../images/confidence-bg.jpg') no-repeat center center;
      background-size: cover;
      padding: 80px 30px;
      color: white;
      text-align: center;
      font-family: 'Georgia', serif;
    }
    .confidence-section h2 {
      font-size: 48px;
      font-style: italic;
      margin-bottom: 20px;
    }
    .confidence-section p {
      font-size: 18px;
      max-width: 700px;
      margin: 0 auto;
      font-weight: 500;
      line-height: 1.6;
    }

    .contact-section {
      background: linear-gradient(to right, #f8f6f0, #ffffff);
      padding: 60px 20px;
      font-size: 14px;
      color: #333;
    }
    .contact-section h5 {
      font-weight: bold;
      font-size: 13px;
      letter-spacing: 2px;
      margin-bottom: 20px;
    }
    .contact-section ul {
      list-style: none;
      padding: 0;
      margin: 0 0 20px;
    }
    .contact-section ul li {
      margin-bottom: 6px;
    }
    .contact-section .social i {
      font-size: 20px;
      margin-right: 15px;
    }
  </style>
</head>
<body>

<!-- Header -->
<div class="top-header">
  <div class="container position-relative">
    <h1 class="brand-title">Rentique</h1>
    <div class="brand-subtitle">CLOTHING</div>
    <div class="nav-icons">
      <a href="#"><i class="bi bi-bag"></i></a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="account.php"><i class="bi bi-person"></i></a>
      <?php else: ?>
        <a href="../index.php#accountModal"><i class="bi bi-person"></i></a>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Navigation Menu -->
<div class="nav-menu">
  <a href="../index.php">Home</a>
  <a href="collections.php">Collections</a>
  <a href="rent-service.php">Rent Service</a>
  <?php if (isset($_SESSION['user_id'])): ?>
    <a href="account.php">My Account</a>
  <?php else: ?>
    <a href="../index.php#accountModal">My Account</a>
  <?php endif; ?>
  <a href="about.php">About Us</a>
</div>

<!-- About Us Section -->
<section class="about-section">
  <h2>About Us</h2>
  <p>
    Rentique is committed to transforming the fashion industry by promoting sustainable fashion through a convenient rental platform.
    We bring local designers to the forefront, showcasing their unique creations while extending the life cycle of garments and reducing clothing waste.
    By offering a curated selection of traditional, formal, and festive wear for rent, Rentique empowers consumers to enjoy high-quality fashion responsibly,
    supporting both environmental sustainability and the growth of local fashion talent.
  </p>
</section>

<!-- FAQ Section -->
<section class="faq-section">
  <h2>Frequently Asked Questions</h2>
  <div class="container">
    <div class="accordion" id="faqAccordion">
      <?php
      $faqs = [
        ["How fast is shipping?", "Orders are shipped within 1-3 business days."],
        ["Do I get to choose my items?", "Yes, you select every item you rent from our curated collections."],
        ["How do I return my order?", "Returns are simple. Just use the return label provided in your order."],
        ["How often do you drop new arrivals?", "New arrivals are added weekly to keep things fresh and trendy."],
        ["What happens if I spill on my rental?", "Don’t worry! Normal wear and tear is covered. Just let us know."]
      ];
      foreach ($faqs as $index => $faq): ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#q<?= $index ?>">
              <?= $faq[0] ?>
            </button>
          </h2>
          <div id="q<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body"><?= $faq[1] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <p class="mt-4 fw-bold">Still Have Questions?</p>
    <p class="small">Visit the FAQ page for more information on all things renting, purchasing and beyond.</p>
  </div>
</section>

<!-- Confidence Section -->
<section class="confidence-section">
  <h2>Confidence, Delivered</h2>
  <p>
    When you look good, you feel good. Our mission is to help you show up looking and feeling like your best self for all of life's moments, big and small.
  </p>
</section>

<!-- Contact Section -->
<section class="contact-section">
  <div class="container">
    <div class="row text-start">
      <div class="col-md-4">
        <h5>INFORMATION</h5>
        <ul>
          <li>About Us</li>
          <li>Our Brands</li>
          <li>Gift Cards</li>
          <li>Our Blog</li>
          <li>FAQs</li>
          <li>Shipping & Returns</li>
          <li>Privacy Policy</li>
          <li>Terms of Service</li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>CONTACT</h5>
        <ul>
          <li>Careers</li>
          <li>Press</li>
          <li>Contact Us</li>
          <li>Report a Bug</li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>SOCIAL</h5>
        <div class="social mb-3">
          <i class="bi bi-instagram"></i>
          <i class="bi bi-whatsapp"></i>
        </div>
        <img src="../images/appstore-badge.png" alt="Download on App Store" style="height:60px;">
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <p class="mb-0">© 2025 Rentique. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
