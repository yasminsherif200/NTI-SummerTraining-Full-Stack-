<?php require_once 'includes/config.php';

// Associative array of products: key = product name,
// value = array of price, img, desc (exactly like the hint in the brief).
$products = [
    'Product 1' => [
        'price' => '620',
        'img'   => 'img/1.png',
        'desc'  => 'A comfy everyday essential, great value for the price.'
    ],
    'Product 2' => [
        'price' => '6500',
        'img'   => 'img/2.png',
        'desc'  => 'Premium quality, built to last for years.'
    ],
    'Product 3' => [
        'price' => '350',
        'img'   => 'img/3.png',
        'desc'  => 'Lightweight and easy to carry around.'
    ],
    'Product 4' => [
        'price' => '1200',
        'img'   => 'img/4.png',
        'desc'  => 'Our best seller this month.'
    ],
    'Product 5' => [
        'price' => '899',
        'img'   => 'img/5.png',
        'desc'  => 'Sleek design with a modern finish.'
    ],
    'Product 6' => [
        'price' => '2450',
        'img'   => 'img/6.png',
        'desc'  => 'Limited stock, grab it before it is gone.'
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShopEasy - All Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require_once 'includes/navbar.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">All Products</h2>
    <div class="row">
        <?php foreach ($products as $product => $values): ?>
            <div class="col-md-4 product-card">
                <div class="card h-100">
                    <img src="<?php echo h($values['img']); ?>" class="card-img-top" alt="<?php echo h($product); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo h($product); ?></h5>
                        <p class="card-text"><?php echo h($values['desc']); ?></p>
                        <p class="card-text"><strong>$<?php echo h($values['price']); ?></strong></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
