<?php
session_start();
$collection = $_GET['collection'] ?? 'alia-bastamam';

// Map titles for page heading
$collection_titles = [
  'alia-bastamam'  => 'Local Designers: Alia Bastamam (Alia B.)',
  'teh-firdaus'     => 'Local Designers: Teh Firdaus',
  'nurita-harith'   => 'Local Designers: Nurita Harith',
  'fiziwoo'         => 'Local Designers: Fiziwoo',
  'annabu'          => 'Local Brands: Annabu',
  'lubna'           => 'Local Brands: Lubna',
  'caftanist'       => 'Local Brands: Caftanist',
  'malay-wear'      => 'Traditional Malay Wear',
  'chinese-wear'    => 'Traditional Chinese Wear',
  'indian-wear'     => 'Traditional Indian Wear',
  'formal-wear'     => 'Formal Wear',
  'maternity-wear'  => 'Maternity Wear'
];

$page_title = $collection_titles[$collection] ?? ucfirst(str_replace('-', ' ', $collection));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($page_title) ?> - Rentique</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
  --primary: #d8c1a8;
  --secondary: #3a2f2f;
  --light: #f9f6ef;
  --accent: #a38f7c;
  --white: #ffffff;
  --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
  --shadow-md: 0 4px 12px rgba(0,0,0,0.12);
  --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

body {
  background-color: var(--light);
  font-family: 'Helvetica Neue', sans-serif;
  color: var(--secondary);
  margin: 0;
  padding: 0;
  line-height: 1.6;
}

/* Enhanced Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 30px 5% 20px;
  background: linear-gradient(rgba(58, 47, 47, 0.85), rgba(58, 47, 47, 0.85)), 
              url('../images/silk-bg.jpg') no-repeat center center;
  background-size: cover;
  color: white;
  position: relative;
  box-shadow: var(--shadow-md);
}

.header::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--primary), transparent);
}

.header .back-btn {
  background: transparent;
  color: var(--white);
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: uppercase;
  border: 1px solid var(--primary);
  padding: 8px 20px;
  border-radius: 30px;
  text-decoration: none;
  transition: var(--transition);
  display: flex;
  align-items: center;
  gap: 6px;
}

.header .back-btn:hover {
  background: rgba(216, 193, 168, 0.2);
  transform: translateX(-3px);
}

.header .back-btn::before {
  content: '←';
}

.collection-title {
  font-weight: 500;
  font-size: 18px;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--white);
  position: relative;
  padding-bottom: 8px;
}

.collection-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 40px;
  height: 2px;
  background: var(--primary);
}

.sort-label {
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: rgba(255,255,255,0.8);
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Enhanced Collection Grid */
.collection-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 30px;
  padding: 5% 5%;
  max-width: 1400px;
  margin: 0 auto;
}

.item-card {
  background-color: var(--white);
  border-radius: 12px;
  overflow: hidden;
  text-align: center;
  box-shadow: var(--shadow-sm);
  transition: var(--transition);
  position: relative;
}

.item-card:hover {
  transform: translateY(-8px);
  box-shadow: var(--shadow-md);
}

.item-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--primary), var(--accent));
  opacity: 0;
  transition: var(--transition);
}

.item-card:hover::before {
  opacity: 1;
}

.item-card img {
  width: 100%;
  height: 280px;
  object-fit: cover;
  background: linear-gradient(45deg, #f5f5f5, #e0e0e0);
  transition: var(--transition);
}

.item-card:hover img {
  filter: brightness(1.02);
}

.item-info {
  padding: 18px 15px;
}

.item-card h5 {
  font-size: 16px;
  font-weight: 500;
  margin: 0 0 6px;
  letter-spacing: 0.5px;
}

.item-card p {
  margin: 0;
  color: var(--accent);
  font-weight: 600;
  font-size: 15px;
  letter-spacing: 0.5px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .header {
    flex-direction: column;
    gap: 20px;
    text-align: center;
    padding: 25px 5%;
  }
  
  .collection-title::after {
    width: 60px;
  }
  
  .collection-grid {
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
    padding: 30px 5%;
  }
  
  .item-card img {
    height: 240px;
  }
}

@media (max-width: 480px) {
  .collection-grid {
    grid-template-columns: 1fr;
    max-width: 320px;
  }
  
  .item-card {
    width: 100%;
  }
}

/* Micro-interactions */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.collection-grid {
  animation: fadeIn 0.6s ease-out;
}

.item-card {
  animation: fadeIn 0.4s ease-out;
  animation-fill-mode: both;
}

/* Create staggered animation */
.item-card:nth-child(1) { animation-delay: 0.1s; }
.item-card:nth-child(2) { animation-delay: 0.2s; }
.item-card:nth-child(3) { animation-delay: 0.3s; }
.item-card:nth-child(4) { animation-delay: 0.4s; }
/* Add more as needed */
  </style>
</head>
<body>

<div class="header">
  <a href="collections.php" class="back-btn">← Back</a>
  <div class="collection-title"><?= htmlspecialchars($page_title) ?></div>
  <div class="sort-label">Sort by Featured</div>
</div>

<div class="collection-grid">
  <?php if ($collection === 'alia-bastamam'): ?>
    <div class="item-card">
  <img src="../images/amaya.jpg" alt="Amaya Dress">
  <h5>Amaya Dress</h5>
  <p>RM200</p>
  <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Amaya Dress">
    <input type="hidden" name="price" value="200">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
  </div>
    <div class="item-card">
      <img src="../images/ally.jpg" alt="Ally Draped Dress">
      <h5>Ally Draped Dress</h5>
      <p>RM190</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Ally Draped Dress">
    <input type="hidden" name="price" value="190">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/alora.jpg" alt="Alora Dress in Lilac">
      <h5>Alora Dress in Lilac</h5>
      <p>RM190</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Alora Dress in Lilac">
    <input type="hidden" name="price" value="190">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/kaftan.jpg" alt="Alia Kaftan">
      <h5>Alia Kaftan</h5>
      <p>RM180</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Alia Kaftan">
    <input type="hidden" name="price" value="180">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

  <?php elseif ($collection === 'teh-firdaus'): ?>
    <div class="item-card">
      <img src="../images/teh1.jpg" alt="Azalea Kebaya">
      <h5>Azalea Kebaya</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Azalea Kebaya">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/teh2.jpg" alt="Iris Kurung">
      <h5>Iris Kurung</h5>
      <p>RM160</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Iris Kurung">
    <input type="hidden" name="price" value="160">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/teh3.jpg" alt="Lace Kebaya Set White">
      <h5>Lace Kebaya Set White</h5>
      <p>RM119</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Lace Kebaya Set White">
    <input type="hidden" name="price" value="119">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/teh4.jpg" alt="Long Floral Kurung Dusty Pink">
      <h5>Long Floral Kurung Dusty Pink</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Long Floral Kurung Dusty Pink">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

<?php elseif ($collection === 'nurita-harith'): ?>
    <div class="item-card">
      <img src="../images/nurita1.jpg" alt="Bayu Kurung">
      <h5>Bayu Kurung</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Bayu Kurung">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/nurita2.jpg" alt="Indah Kurung">
      <h5>Indah Kurung</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Indah Kurung">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/nurita3.jpg" alt="Rose Kurung Kedah">
      <h5>Rose Kurung Kedah</h5>
      <p>RM119</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Rose Kurung Kedah">
    <input type="hidden" name="price" value="119">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/nurita4.jpg" alt="Long Floral Kurung Dusty Pink">
      <h5>Long Floral Kurung Dusty Pink</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Long Floral Kurung Dusty Pink">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'fiziwoo'): ?>
    <div class="item-card">
      <img src="../images/fiziwoo1.jpg" alt="White Drape Dress">
      <h5>White Drape Dress</h5>
      <p>RM250</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="White Drape Dress">
    <input type="hidden" name="price" value="250">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/fiziwoo2.jpg" alt="Dusty Blue Dress">
      <h5>Dusty Blue Dress</h5>
      <p>RM190</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Dusty Blue Dress">
    <input type="hidden" name="price" value="190">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/fiziwoo3.jpg" alt="Pink Ateliar Dress">
      <h5>Pink Ateliar Dress</h5>
      <p>RM200</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Pink Ateliar Dress">
    <input type="hidden" name="price" value="200">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/fiziwoo4.jpg" alt="Mint Drape Dress">
      <h5>Mint Drape Dress</h5>
      <p>RM180</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Mint Drape Dress">
    <input type="hidden" name="price" value="180">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'annabu'): ?>
    <div class="item-card">
      <img src="../images/annabu1.jpg" alt="Batik Skirt">
      <h5>Batik Skirt</h5>
      <p>RM100</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Batik Skirt">
    <input type="hidden" name="price" value="100">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/annabu2.jpg" alt="Tenunan Mermaid Skirt">
      <h5>Tenunan Mermaid Skirt</h5>
      <p>RM160</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Tenunan Mermaid Skirt">
    <input type="hidden" name="price" value="160">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/annabu3.jpg" alt="Dream Top">
      <h5>Dream Top</h5>
      <p>RM100</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Dream Top">
    <input type="hidden" name="price" value="100">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/annabu4.jpg" alt="Floral top">
      <h5>Floral top</h5>
      <p>RM180</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Floral top">
    <input type="hidden" name="price" value="180">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'lubna'): ?>
    <div class="item-card">
      <img src="../images/lubna1.jpg" alt="Kurung Lace Set">
      <h5>Kurung Lace Set</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Kurung Lace Set">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/lubna2.jpg" alt="Dusty Blue Top Kebaya">
      <h5>Dusty Blue Top Kebaya</h5>
      <p>RM80</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Dusty Blue Top Kebaya">
    <input type="hidden" name="price" value="80">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/lubna3.jpg" alt="Baby Pink Top Kebaya">
      <h5>Baby Pink Top Kebaya</h5>
      <p>RM80</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Baby Pink Top Kebaya">
    <input type="hidden" name="price" value="80">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/lubna4.jpg" alt="Cyan Top Kebaya">
      <h5>Cyan Top Kebaya</h5>
      <p>RM80</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Cyan Top Kebaya">
    <input type="hidden" name="price" value="80">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'caftanist'): ?>
    <div class="item-card">
      <img src="../images/caftanist1.jpg" alt="White Kurung Dress">
      <h5>White Kurung Dress</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="White Kurung Dress">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/caftanist2.jpg" alt="English Dress">
      <h5>English Dress</h5>
      <p>RM150</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="English Dress">
    <input type="hidden" name="price" value="150">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/caftanist3.jpg" alt="Floral Lace Kaftan">
      <h5>Floral Lace Kaftan</h5>
      <p>RM160</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Floral Lace Kaftan">
    <input type="hidden" name="price" value="160">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/caftanist4.jpg" alt="Pink Lace Kaftan">
      <h5>Pink Lace Kaftan</h5>
      <p>RM180</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Pink Lace Kaftan">
    <input type="hidden" name="price" value="180">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'malay-wear'): ?>
    <div class="item-card">
      <img src="../images/malay1.jpg" alt="Laila Nyonya Kebaya Brown">
      <h5>Laila Nyonya Kebaya Brown</h5>
      <p>RM90</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Laila Nyonya Kebaya Brown">
    <input type="hidden" name="price" value="90">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/malay2.jpg" alt="Saleha Kurung Kedah Sage Green">
      <h5>Saleha Kurung Kedah Sage Green</h5>
      <p>RM50</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Saleha Kurung Kedah Sage Green">
    <input type="hidden" name="price" value="50">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/malay3.jpg" alt="Lace Kebaya Set Nude">
      <h5>Lace Kebaya Set Nude</h5>
      <p>RM119</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Lace Kebaya Set Nude">
    <input type="hidden" name="price" value="119">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/malay4.jpg" alt="Long Floral Kurung Dusty Pink">
      <h5>Long Floral Kurung Dusty Pink</h5>
      <p>RM60</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Long Floral Kurung Dusty Pink">
    <input type="hidden" name="price" value="60">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'chinese-wear'): ?>
    <div class="item-card">
      <img src="../images/chinese1.jpg" alt="Grace Cheongsam Offwhite">
      <h5>Grace Cheongsam Offwhite</h5>
      <p>RM75</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Grace Cheongsam Offwhite">
    <input type="hidden" name="price" value="75">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/chinese2.jpg" alt="Mei Cheongsam Emerald Green">
      <h5>Mei Cheongsam Emerald Green</h5>
      <p>RM90</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Mei Cheongsam Emerald Green">
    <input type="hidden" name="price" value="90">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/chinese3.jpg" alt="Bloom Cheongsam Champagne">
      <h5>Bloom Cheongsam Champagne</h5>
      <p>RM120</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Bloom Cheongsam Champagne">
    <input type="hidden" name="price" value="120">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/chinese4.jpg" alt="Luna Cheongsam Redwine">
      <h5>Luna Cheongsam Redwine</h5>
      <p>RM110</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Luna Cheongsam Redwine">
    <input type="hidden" name="price" value="110">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/chinese5.jpg" alt="Shanghai Satin Cheongsam Blue">
      <h5>Shanghai Satin Cheongsam Blue</h5>
      <p>RM60</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Shanghai Satin Cheongsam Blue">
    <input type="hidden" name="price" value="60">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'indian-wear'): ?>
    <div class="item-card">
      <img src="../images/indian1.jpg" alt="Serene Sindooor Sari Yellow">
      <h5>Serene Sindooor Sari Yellow</h5>
      <p>RM79</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Serene Sindooor Sari Yellow">
    <input type="hidden" name="price" value="79">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/indian2.jpg" alt="Silken Silk Sari Skyblue">
      <h5>Silken Silk Sari Skyblue</h5>
      <p>RM80</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Silken Silk Sari Skyblue">
    <input type="hidden" name="price" value="80">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/indian3.jpg" alt="Desi Drape Sari Fushcia Pink">
      <h5>Desi Drape Sari Fushcia Pink</h5>
      <p>RM79</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Desi Drape Sari Fushcia Pink">
    <input type="hidden" name="price" value="79">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/indian4.jpg" alt="Kanchan Sari Lemon Green">
      <h5>Kanchan Sari Lemon Green</h5>
      <p>RM75</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Kanchan Sari Lemon Green">
    <input type="hidden" name="price" value="75">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'formal-wear'): ?>
    <div class="item-card">
      <img src="../images/formal1.jpg" alt="Opal Grace Set Green">
      <h5>Opal Grace Set Green</h5>
      <p>RM99</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Opal Grace Set Green">
    <input type="hidden" name="price" value="99">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/formal2.jpg" alt="Lux Line Jumpsuit Hotpink">
      <h5>Lux Line Jumpsuit Hotpink</h5>
      <p>RM115</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Lux Line Jumpsuit Hotpink">
    <input type="hidden" name="price" value="115">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/formal3.jpg" alt="The Noir Jumpsuit Jetblack">
      <h5>The Noir Jumpsuit Jetblack</h5>
      <p>RM125</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="The Noir Jumpsuit Jetblack">
    <input type="hidden" name="price" value="125">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/formal4.jpg" alt="Midnight Jumpsuit Blue">
      <h5>Midnight Jumpsuit Blue</h5>
      <p>RM110</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Midnight Jumpsuit Blue">
    <input type="hidden" name="price" value="110">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/formal4.jpg" alt="Velvet Dress Flamingo Pink">
      <h5>Velvet Dress Flamingo Pink</h5>
      <p>RM99</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Velvet Dress Flamingo Pink">
    <input type="hidden" name="price" value="99">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

    <?php elseif ($collection === 'maternity-wear'): ?>
    <div class="item-card">
      <img src="../images/maternity1.jpg" alt="Glow Sarin Dress Dusty Pink">
      <h5>Glow Sarin Dress Dusty Pink</h5>
      <p>RM80</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Glow Sarin Dress Dusty Pink">
    <input type="hidden" name="price" value="80">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/maternity2.jpg" alt="Fancy Lace Dress Skyblue">
      <h5>Fancy Lace Dress Skyblue</h5>
      <p>RM80</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Fancy Lace Dress Skyblue">
    <input type="hidden" name="price" value="80">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/maternity3.jpg" alt="Bougee Sleeveless Dress Nude">
      <h5>Bougee Sleeveless Dress Nude</h5>
      <p>RM60</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Bougee Sleeveless Dress Nude">
    <input type="hidden" name="price" value="60">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>
    <div class="item-card">
      <img src="../images/maternity4.jpg" alt="Serenity Glow Dress Purple">
      <h5>Serenity Glow Dress Purple</h5>
      <p>RM90</p>
      <form action="cart.php" method="POST">
    <input type="hidden" name="item_name" value="Serenity Glow Dress Purple">
    <input type="hidden" name="price" value="90">
    <button type="submit" class="btn btn-sm btn-primary mt-2">Add to Cart</button>
  </form>
    </div>

  <?php else: ?>
    <p>No items available for this collection.</p>
  <?php endif; ?>
</div>

</body>
</html>
