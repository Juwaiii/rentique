<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rent Service - Rentique</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #d8c1a8;
      --secondary: #3a2f2f;
      --light: #f9f6ef;
      --accent: #a38f7c;
      --white: #ffffff;
    }
    
    body {
      font-family: 'Helvetica Neue', sans-serif;
      background-color: var(--light);
      color: var(--secondary);
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }
    
    /* Navigation */
    .nav-container {
      width: 100%;
      background-color: var(--white);
      padding: 20px 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      text-align: center;
    }
    
    .brand-title {
      font-size: 28px;
      font-weight: 500;
      margin-bottom: 10px;
      color: var(--secondary);
    }
    
    .nav-menu {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 15px;
    }
    
    .nav-menu a {
      color: var(--secondary);
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 1px;
      position: relative;
    }
    
    .nav-menu a:after {
      content: '';
      position: absolute;
      width: 0;
      height: 1px;
      bottom: -3px;
      left: 0;
      background-color: var(--accent);
      transition: width 0.3s;
    }
    
    .nav-menu a:hover:after {
      width: 100%;
    }
    
    .category-label {
      font-size: 12px;
      color: var(--accent);
      letter-spacing: 2px;
      margin-top: 5px;
    }
    
    /* Main Content */
    .main-container {
      width: 100%;
      max-width: 800px;
      margin: 40px auto;
      padding: 0 20px;
    }
    
    .rent-content {
      background-color: var(--white);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    
    /* Rest of your existing styles... */
    .plan-header h1 {
      font-size: 2.5rem;
      font-weight: 300;
      letter-spacing: 1px;
      margin-bottom: 10px;
      color: var(--secondary);
      text-align: center;
    }
    
    .plan-header p {
      color: var(--accent);
      font-size: 1.1rem;
      margin-bottom: 30px;
      text-align: center;
    }
    
    .plan-features {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }
    
    .feature-card {
      width: 150px;
      background: var(--white);
      border: 1px solid rgba(216, 193, 168, 0.3);
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      transition: all 0.3s ease;
    }
    
    .feature-value {
      font-size: 2rem;
      font-weight: 600;
      color: var(--secondary);
      margin-bottom: 5px;
    }
    
    .feature-label {
      font-size: 0.9rem;
      color: var(--accent);
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .pricing-box {
      background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
      color: var(--white);
      padding: 20px;
      border-radius: 8px;
      margin: 0 auto 30px;
      max-width: 400px;
      position: relative;
    }
    
    .pricing-box::before {
      content: "Limited Time Offer";
      position: absolute;
      top: 0;
      right: 0;
      background: var(--secondary);
      color: var(--white);
      padding: 5px 15px;
      font-size: 0.8rem;
      border-bottom-left-radius: 8px;
    }
    
    .original-price {
      text-decoration: line-through;
      opacity: 0.7;
      margin-right: 10px;
    }
    
    .current-price {
      font-size: 1.8rem;
      font-weight: 600;
    }
    
    .cta-btn {
      background: var(--secondary);
      color: var(--white);
      padding: 15px 40px;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      letter-spacing: 1px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin: 20px auto;
      display: block;
      max-width: 300px;
    }
    
    .cta-btn:hover {
      background: var(--accent);
      transform: translateY(-2px);
    }
    
    .benefits-list {
      margin: 40px auto 0;
      max-width: 500px;
      text-align: left;
    }
    
    .benefit-item {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .benefit-icon {
      color: var(--primary);
      margin-right: 15px;
      font-size: 1.2rem;
    }
    
    /* Payment Modal */
    .payment-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }
    
    .payment-form {
      background-color: var(--white);
      width: 100%;
      max-width: 500px;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }
    
    .payment-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .payment-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--secondary);
    }
    
    .close-btn {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--accent);
    }
    
    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }
    
    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
    }
    
    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
    }
    
    .row {
      display: flex;
      gap: 20px;
    }
    
    .col {
      flex: 1;
    }
    
    .submit-btn {
      background-color: var(--secondary);
      color: var(--white);
      border: none;
      padding: 15px;
      width: 100%;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      margin-top: 10px;
    }
    
    @media (max-width: 768px) {
      .nav-menu {
        gap: 15px;
        flex-wrap: wrap;
      }
      
      .plan-header h1 {
        font-size: 2rem;
      }
      
      .plan-features {
        flex-direction: column;
        align-items: center;
      }
      
      .feature-card {
        width: 100%;
        max-width: 200px;
      }
      
      .row {
        flex-direction: column;
        gap: 0;
      }
    }
  </style>
</head>
<body>

<!-- Navigation -->
<div class="nav-container">
  <div class="brand-title">Rentique</div>
  <div class="category-label">CLOTHING</div>
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
</div>

<!-- Main Content -->
<div class="main-container">
  <div class="rent-content">
    <div class="plan-header">
      <h1>Premium Fashion Rental Membership</h1>
      <p>Access luxury fashion without the commitment</p>
    </div>
    
    <div class="plan-features">
      <div class="feature-card">
        <div class="feature-value">10</div>
        <div class="feature-label">Items</div>
      </div>
      <div class="feature-card">
        <div class="feature-value">2</div>
        <div class="feature-label">Orders/Month</div>
      </div>
      <div class="feature-card">
        <div class="feature-value">5</div>
        <div class="feature-label">Items/Order</div>
      </div>
    </div>
    
    <div class="pricing-box">
      <div class="d-flex align-items-center justify-content-center">
        <span class="original-price">RM89</span>
        <span class="current-price">RM49</span>
        <span class="price-period">/month</span>
      </div>
      <p class="mt-2 mb-0">Try our premium service at introductory pricing</p>
    </div>
    
    <button class="cta-btn" id="startMembershipBtn">Start Your Membership</button>
    
    <div class="benefits-list">
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-check-circle"></i></div>
        <div>Unlimited access to our premium collection</div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-check-circle"></i></div>
        <div>Free delivery and returns</div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-check-circle"></i></div>
        <div>Exclusive member events</div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-check-circle"></i></div>
        <div>Priority customer support</div>
      </div>
    </div>
  </div>
</div>

<!-- Payment Modal -->
<div class="payment-modal" id="paymentModal">
  <div class="payment-form">
    <div class="payment-header">
      <h3 class="payment-title">Payment Information</h3>
      <button class="close-btn" id="closeModal">&times;</button>
    </div>
    
    <form id="paymentForm">
      <div class="form-group">
        <label class="form-label">Cardholder Name</label>
        <input type="text" class="form-control" placeholder="Name on card" required>
      </div>
      
      <div class="form-group">
        <label class="form-label">Card Number</label>
        <input type="text" class="form-control" placeholder="1234 5678 9012 3456" required>
      </div>
      
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label class="form-label">Expiration Date</label>
            <input type="text" class="form-control" placeholder="MM/YY" required>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label class="form-label">CVV</label>
            <input type="text" class="form-control" placeholder="123" required>
          </div>
        </div>
      </div>
      
      <button type="submit" class="submit-btn">Complete Payment (RM49)</button>
    </form>
  </div>
</div>

<script>
  // Modal functionality
  const paymentModal = document.getElementById('paymentModal');
  const startMembershipBtn = document.getElementById('startMembershipBtn');
  const closeModal = document.getElementById('closeModal');
  const paymentForm = document.getElementById('paymentForm');
  
  startMembershipBtn.addEventListener('click', () => {
    paymentModal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  });
  
  closeModal.addEventListener('click', () => {
    paymentModal.style.display = 'none';
    document.body.style.overflow = 'auto';
  });
  
  paymentModal.addEventListener('click', (e) => {
    if (e.target === paymentModal) {
      paymentModal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
  });
  
  paymentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Payment processed successfully! Welcome to Rentique Premium.');
    paymentModal.style.display = 'none';
    document.body.style.overflow = 'auto';
  });
  
  // Input formatting
  const cardNumberInput = document.querySelector('input[placeholder="1234 5678 9012 3456"]');
  cardNumberInput.addEventListener('input', function(e) {
    let value = this.value.replace(/\D/g, '');
    value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    this.value = value;
  });
  
  const expDateInput = document.querySelector('input[placeholder="MM/YY"]');
  expDateInput.addEventListener('input', function(e) {
    let value = this.value.replace(/\D/g, '');
    if (value.length > 2) {
      value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    this.value = value;
  });
</script>
<!-- Boutique-Style How It Works Section -->
<section style="background: #f9f6ef; padding: 100px 20px; font-family: 'Helvetica Neue', sans-serif; position: relative;">
  <!-- Decorative Elements -->
  <div style="position: absolute; top: 50px; left: 5%; width: 30px; height: 1px; background: #d8c1a8;"></div>
  <div style="position: absolute; bottom: 50px; right: 5%; width: 30px; height: 1px; background: #d8c1a8;"></div>
  
  <div class="container">
    <!-- Section Header -->
    <div class="text-center mb-12" style="position: relative;">
      <span style="font-size: 14px; letter-spacing: 4px; color: #a38f7c; display: block; margin-bottom: 10px;">THE RENTIQUE EXPERIENCE</span>
      <h2 style="font-size: 36px; font-weight: 300; letter-spacing: 2px; margin-bottom: 20px;">How Our Service Works</h2>
      <div style="width: 80px; height: 1px; background: #d8c1a8; margin: 0 auto;"></div>
    </div>

    <!-- Process Steps -->
    <div class="row g-5 justify-content-center position-relative">
      <!-- Decorative Line -->
      <div style="position: absolute; top: 120px; left: 0; right: 0; height: 1px; background: rgba(216, 193, 168, 0.3); z-index: 1;"></div>
      
      <!-- Step 1 -->
      <div class="col-md-6 col-lg-3 position-relative" style="z-index: 2;">
        <div class="text-center" style="padding: 40px 30px; background: white; box-shadow: 0 5px 25px rgba(0,0,0,0.03); position: relative;">
          <div style="width: 80px; height: 80px; border-radius: 50%; background: #f9f6ef; border: 1px solid #d8c1a8; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
            <span style="font-size: 28px; color: #3a2f2f; font-weight: 300;">01</span>
          </div>
          <h5 style="font-weight: 400; letter-spacing: 1px; margin-bottom: 20px; position: relative;">
            <span style="display: inline-block; padding-bottom: 10px; border-bottom: 1px solid #d8c1a8;">Curate Your Look</span>
          </h5>
          <p style="color: #6e6e6e; line-height: 1.8; font-size: 15px;">
            Select 5 premium pieces from our collection, plus a complimentary accessory to complete your ensemble.
          </p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="col-md-6 col-lg-3 position-relative" style="z-index: 2;">
        <div class="text-center" style="padding: 40px 30px; background: white; box-shadow: 0 5px 25px rgba(0,0,0,0.03); position: relative;">
          <div style="width: 80px; height: 80px; border-radius: 50%; background: #f9f6ef; border: 1px solid #d8c1a8; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
            <span style="font-size: 28px; color: #3a2f2f; font-weight: 300;">02</span>
          </div>
          <h5 style="font-weight: 400; letter-spacing: 1px; margin-bottom: 20px; position: relative;">
            <span style="display: inline-block; padding-bottom: 10px; border-bottom: 1px solid #d8c1a8;">Flexible Rotation</span>
          </h5>
          <p style="color: #6e6e6e; line-height: 1.8; font-size: 15px;">
            Enjoy two monthly shipments. Return your first order to immediately begin your next style rotation.
          </p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="col-md-6 col-lg-3 position-relative" style="z-index: 2;">
        <div class="text-center" style="padding: 40px 30px; background: white; box-shadow: 0 5px 25px rgba(0,0,0,0.03); position: relative;">
          <div style="width: 80px; height: 80px; border-radius: 50%; background: #f9f6ef; border: 1px solid #d8c1a8; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
            <span style="font-size: 28px; color: #3a2f2f; font-weight: 300;">03</span>
          </div>
          <h5 style="font-weight: 400; letter-spacing: 1px; margin-bottom: 20px; position: relative;">
            <span style="display: inline-block; padding-bottom: 10px; border-bottom: 1px solid #d8c1a8;">Luxury Delivery</span>
          </h5>
          <p style="color: #6e6e6e; line-height: 1.8; font-size: 15px;">
            Receive your carefully packaged items within 1-3 business days, with complimentary shipping both ways.
          </p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="col-md-6 col-lg-3 position-relative" style="z-index: 2;">
        <div class="text-center" style="padding: 40px 30px; background: white; box-shadow: 0 5px 25px rgba(0,0,0,0.03); position: relative;">
          <div style="width: 80px; height: 80px; border-radius: 50%; background: #f9f6ef; border: 1px solid #d8c1a8; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
            <span style="font-size: 28px; color: #3a2f2f; font-weight: 300;">04</span>
          </div>
          <h5 style="font-weight: 400; letter-spacing: 1px; margin-bottom: 20px; position: relative;">
            <span style="display: inline-block; padding-bottom: 10px; border-bottom: 1px solid #d8c1a8;">Effortless Returns</span>
          </h5>
          <p style="color: #6e6e6e; line-height: 1.8; font-size: 15px;">
            Simply place items in our signature return bag. We handle all cleaning and maintenance for you.
          </p>
        </div>
      </div>
    </div>

    <!-- Boutique Signature -->
    <div class="text-center mt-8" style="margin-top: 80px !important;">
      <p style="font-size: 14px; letter-spacing: 2px; color: #a38f7c;">
        <span style="border-top: 1px solid #d8c1a8; border-bottom: 1px solid #d8c1a8; padding: 8px 0; display: inline-block;">
          RENTIQUE BOUTIQUE SERVICE
        </span>
      </p>
    </div>
  </div>
</section>
<!-- Boutique Member Favorites Section -->
<section style="background: #f9f6ef; padding: 100px 20px; font-family: 'Helvetica Neue', sans-serif; position: relative;">
  <!-- Decorative Elements -->
  <div style="position: absolute; top: 80px; left: 5%; width: 30px; height: 1px; background: #d8c1a8;"></div>
  <div style="position: absolute; bottom: 80px; right: 5%; width: 30px; height: 1px; background: #d8c1a8;"></div>
  
  <div class="container">
    <!-- Section Header -->
    <div class="text-center mb-8">
      <h2 style="font-size: 14px; letter-spacing: 4px; color: #a38f7c; margin-bottom: 15px; text-transform: uppercase;">MEMBER FAVOURITES</h2>
      <div style="width: 40px; height: 1px; background: #d8c1a8; margin: 0 auto 30px;"></div>
    </div>

    <!-- Collection Items -->
    <div class="row g-4 justify-content-center">
     <!-- Item 1 -->
<div class="col-6 col-md-4 col-lg-2">
  <div style="position: relative; margin-bottom: 15px;">
    <div style="height: 250px; background: #eee; background-image: url('../images/kebaya.jpg'); background-size: cover; background-position: center;"></div>
    <div style="position: absolute; top: 15px; left: 15px; background: white; padding: 3px 8px; font-size: 10px; letter-spacing: 1px;">NEW</div>
  </div>
  <div style="text-align: center;">
    <p style="font-size: 12px; letter-spacing: 1px; color: #a38f7c; margin-bottom: 5px;">Kebaya Series</p>
    <h3 style="font-size: 14px; font-weight: 400; letter-spacing: 0.5px; margin-bottom: 8px;">Salma Kebaya Green S</h3>
    <p style="font-size: 14px; margin-bottom: 15px;">RM70</p>
    <a href="#" style="display: inline-block; padding: 8px 0; border-bottom: 1px solid #3a2f2f; color: #3a2f2f; text-decoration: none; letter-spacing: 1px; font-size: 11px; text-transform: uppercase;">Rent Now</a>
  </div>
</div>

<!-- Item 2 -->
<div class="col-6 col-md-4 col-lg-2">
  <div style="position: relative; margin-bottom: 15px;">
    <div style="height: 250px; background: #eee; background-image: url('../images/cheongsam.jpg'); background-size: cover; background-position: center;"></div>
  </div>
  <div style="text-align: center;">
    <p style="font-size: 12px; letter-spacing: 1px; color: #a38f7c; margin-bottom: 5px;">Cheongsam Series</p>
    <h3 style="font-size: 14px; font-weight: 400; letter-spacing: 0.5px; margin-bottom: 8px;">Melhuang Cheongsam Redwine XS</h3>
    <p style="font-size: 14px; margin-bottom: 15px;">RM60</p>
    <a href="#" style="display: inline-block; padding: 8px 0; border-bottom: 1px solid #3a2f2f; color: #3a2f2f; text-decoration: none; letter-spacing: 1px; font-size: 11px; text-transform: uppercase;">Rent Now</a>
  </div>
</div>

<!-- Item 3 -->
<div class="col-6 col-md-4 col-lg-2">
  <div style="position: relative; margin-bottom: 15px;">
    <div style="height: 250px; background: #eee; background-image: url('../images/sari.jpg'); background-size: cover; background-position: center;"></div>
    <div style="position: absolute; top: 15px; left: 15px; background: white; padding: 3px 8px; font-size: 10px; letter-spacing: 1px;">BESTSELLER</div>
  </div>
  <div style="text-align: center;">
    <p style="font-size: 12px; letter-spacing: 1px; color: #a38f7c; margin-bottom: 5px;">Sari Series</p>
    <h3 style="font-size: 14px; font-weight: 400; letter-spacing: 0.5px; margin-bottom: 8px;">Meena Sari Champagne M</h3>
    <p style="font-size: 14px; margin-bottom: 15px;">RM90</p>
    <a href="#" style="display: inline-block; padding: 8px 0; border-bottom: 1px solid #3a2f2f; color: #3a2f2f; text-decoration: none; letter-spacing: 1px; font-size: 11px; text-transform: uppercase;">Rent Now</a>
  </div>
</div>

<!-- Item 4 -->
<div class="col-6 col-md-4 col-lg-2">
  <div style="position: relative; margin-bottom: 15px;">
    <div style="height: 250px; background: #eee; background-image: url('../images/formal.jpg'); background-size: cover; background-position: center;"></div>
  </div>
  <div style="text-align: center;">
    <p style="font-size: 12px; letter-spacing: 1px; color: #a38f7c; margin-bottom: 5px;">Formal Wear</p>
    <h3 style="font-size: 14px; font-weight: 400; letter-spacing: 0.5px; margin-bottom: 8px;">Luxe Suit Set Jetblack M</h3>
    <p style="font-size: 14px; margin-bottom: 15px;">RM60</p>
    <a href="#" style="display: inline-block; padding: 8px 0; border-bottom: 1px solid #3a2f2f; color: #3a2f2f; text-decoration: none; letter-spacing: 1px; font-size: 11px; text-transform: uppercase;">Rent Now</a>
  </div>
</div>

<!-- Item 5 -->
<div class="col-6 col-md-4 col-lg-2">
  <div style="position: relative; margin-bottom: 15px;">
    <div style="height: 250px; background: #eee; background-image: url('../images/maternity.jpg'); background-size: cover; background-position: center;"></div>
  </div>
  <div style="text-align: center;">
    <p style="font-size: 12px; letter-spacing: 1px; color: #a38f7c; margin-bottom: 5px;">Maternity Wear</p>
    <h3 style="font-size: 14px; font-weight: 400; letter-spacing: 0.5px; margin-bottom: 8px;">Golden Satin Dress L</h3>
    <p style="font-size: 14px; margin-bottom: 15px;">RM80</p>
    <a href="#" style="display: inline-block; padding: 8px 0; border-bottom: 1px solid #3a2f2f; color: #3a2f2f; text-decoration: none; letter-spacing: 1px; font-size: 11px; text-transform: uppercase;">Rent Now</a>
  </div>
</div>


    <!-- View All Button -->
    <div class="text-center mt-6" style="margin-top: 60px !important;">
      <a href="collections.php" style="display: inline-block; padding: 12px 40px; background: #3a2f2f; color: white; text-decoration: none; letter-spacing: 2px; font-size: 12px; transition: all 0.3s;">VIEW ALL COLLECTIONS</a>

    </div>
  </div>
</section>


</body>
</html>