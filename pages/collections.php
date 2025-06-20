<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Collections - Rentique</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Helvetica Neue', sans-serif;
      background-color: #f9f6ef;
      color: #3a2f2f;
      margin: 0;
      padding: 0;
    }
    
    .nav-container {
      text-align: center;
      padding: 30px 0;
      background-color: white;
      box-shadow: 0 2px 20px rgba(0,0,0,0.05);
    }
    
    .brand-title {
      font-size: 32px;
      font-weight: 500;
      color: #3a2f2f;
      letter-spacing: 1px;
      margin-bottom: 10px;
    }
    
    .back-btn {
      display: inline-block;
      padding: 10px 25px;
      background-color: #3a2f2f;
      color: white;
      text-decoration: none;
      border-radius: 2px;
      font-size: 12px;
      letter-spacing: 2px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      border: 1px solid #3a2f2f;
    }
    
    .back-btn:hover {
      background-color: transparent;
      color: #3a2f2f;
    }
    
    .collection-header {
      text-align: center;
      margin: 60px 0 40px;
    }
    
    .collection-header h2 {
      font-weight: 300;
      font-size: 32px;
      letter-spacing: 2px;
      color: #a38f7c;
      margin-bottom: 15px;
      text-transform: uppercase;
    }
    
    .header-divider {
      width: 80px;
      height: 1px;
      background: #d8c1a8;
      margin: 0 auto;
    }
    
    .collection-list {
      max-width: 1200px;
      margin: 0 auto 80px;
      padding: 0 20px;
    }
    
    .collection-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 25px;
    }
    
    .collection-item {
      height: 220px;
      display: flex;
      align-items: flex-end;
      justify-content: center;
      padding: 25px;
      color: white;
      text-decoration: none;
      position: relative;
      overflow: hidden;
      border-radius: 4px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      background-size: cover;
      background-position: center;
    }
    
    .collection-item span {
      font-size: 18px;
      letter-spacing: 2px;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
      position: relative;
      z-index: 2;
      transform: translateY(20px);
      transition: all 0.4s ease;
      text-align: center;
      text-transform: uppercase;
    }
    
    .collection-item::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to top, rgba(58, 47, 47, 0.7) 0%, transparent 50%);
      z-index: 1;
      transition: all 0.4s ease;
    }
    
    .collection-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .collection-item:hover span {
      transform: translateY(0);
    }
    
    .collection-item:hover::after {
      height: 120%;
    }
    
    .category-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      padding: 5px 12px;
      font-size: 10px;
      letter-spacing: 1px;
      border-radius: 2px;
      text-transform: uppercase;
      z-index: 3;
      color: white;
    }
    
    .local-designer { background: #d8c1a8; color: #3a2f2f; }
    .local-brand { background: #a38f7c; }
    .traditional { background: #8a6d5b; }
    .formal { background: #6d5b4a; }
    .maternity { background: #5b4a3a; }
    
    /* Collection-specific background images with fallback colors */
    .alia-bastamam { background-color: #e8d5c0; background-image: url('../images/alia.jpg'); }
    .teh-firdaus { background-color: #d1c1b0; background-image: url('../images/teh.jpg'); }
    .nurita-harith { background-color: #c5b8a8; background-image: url('../images/nurita.jpg'); }
    .fiziwoo { background-color: #b8ad9e; background-image: url('../images/fiziwoo.jpg'); }
    .annabu { background-color: #a38f7c; background-image: url('../images/annabu.jpg');; }
    .lubna { background-color: #8a6d5b; background-image: url('../images/lubna.jpg'); }
    .caftanist { background-color: #6d5b4a; background-image: url('../images/caftanist.jpg'); }
    .malay-wear { background-color: #5b4a3a; background-image: url('../images/malay.jpg'); }
    .chinese-wear { background-color: #4a3a2f; background-image: url('../images/chinese.jpg'); }
    .indian-wear { background-color: #3a2f2f; background-image: url('../images/indian.jpg'); }
    .formal-wear { background-color: #2f2a2a; background-image: url('../images/formall.jpg'); }
    .maternity-wear { background-color: #2a2525; background-image: url('../images/maternityy.jpg'); }
    
    @media (max-width: 768px) {
      .collection-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      }
      
      .collection-header h2 {
        font-size: 24px;
      }
    }
    
    @media (max-width: 480px) {
      .collection-grid {
        grid-template-columns: 1fr;
      }
      
      .collection-item {
        height: 180px;
      }
    }
  </style>
</head>
<body>

<div class="nav-container">
  <div class="brand-title">Rentique</div>
  <a href="../index.php" class="back-btn">← Back to Home</a>
</div>

<div class="collection-header">
  <h2>Our Collections</h2>
  <div class="header-divider"></div>
</div>

<div class="collection-list">
  <div class="collection-grid">
    <a href="collection-detail.php?collection=alia-bastamam" class="collection-item alia-bastamam">
      <span>Alia Bastamam</span>
      <div class="category-badge local-designer">Local Designer</div>
    </a>
    
    <a href="collection-detail.php?collection=teh-firdaus" class="collection-item teh-firdaus">
      <span>Teh Firdaus</span>
      <div class="category-badge local-designer">Local Designer</div>
    </a>
    
    <a href="collection-detail.php?collection=nurita-harith" class="collection-item nurita-harith">
      <span>Nurita Harith</span>
      <div class="category-badge local-designer">Local Designer</div>
    </a>
    
    <a href="collection-detail.php?collection=fiziwoo" class="collection-item fiziwoo">
      <span>Fiziwoo</span>
      <div class="category-badge local-designer">Local Designer</div>
    </a>
    
    <a href="collection-detail.php?collection=annabu" class="collection-item annabu">
      <span>Annabu</span>
      <div class="category-badge local-brand">Local Brand</div>
    </a>
    
    <a href="collection-detail.php?collection=lubna" class="collection-item lubna">
      <span>Lubna</span>
      <div class="category-badge local-brand">Local Brand</div>
    </a>
    
    <a href="collection-detail.php?collection=caftanist" class="collection-item caftanist">
      <span>Caftanist</span>
      <div class="category-badge local-brand">Local Brand</div>
    </a>
    
    <a href="collection-detail.php?collection=malay-wear" class="collection-item malay-wear">
      <span>Malay Wear</span>
      <div class="category-badge traditional">Traditional</div>
    </a>
    
    <a href="collection-detail.php?collection=chinese-wear" class="collection-item chinese-wear">
      <span>Chinese Wear</span>
      <div class="category-badge traditional">Traditional</div>
    </a>
    
    <a href="collection-detail.php?collection=indian-wear" class="collection-item indian-wear">
      <span>Indian Wear</span>
      <div class="category-badge traditional">Traditional</div>
    </a>
    
    <a href="collection-detail.php?collection=formal-wear" class="collection-item formal-wear">
      <span>Formal Wear</span>
      <div class="category-badge formal">Formal</div>
    </a>
    
    <a href="collection-detail.php?collection=maternity-wear" class="collection-item maternity-wear">
      <span>Maternity Wear</span>
      <div class="category-badge maternity">Maternity</div>
    </a>
  </div>
</div>

</body>
</html>