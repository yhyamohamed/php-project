<?php
  $title = "Product Details";
  $active = "products";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
  $profile = false;
?>
  <div class="p-5 container">
    <h1 class="mb-5">Product Name</h1>
    <div class="product-image mb-5 border-3" style="background-image: url(https://i.picsum.photos/id/1006/3000/2000.jpg?hmac=x83pQQ7LW1UTo8HxBcIWuRIVeN_uCg0cG6keXvNvM8g)">
    </div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut consequuntur doloremque ea, eum ipsa iusto magnam
      minus molestiae nulla pariatur praesentium quidem, quod sint soluta totam ullam unde velit veniam?</p>
    <p class="lead">
      Purchases Count: 5
    </p>
    <?php if ((!isset($_SESSION['userId']) || $product['created_by'] !== $_SESSION['userId']) && !$profile) { ?>
      <a href="<?= BASE_URL; ?>/payment/payment.php" class="btn btn-primary">Buy Now</a>
    <?php } else { ?>
      <a href="<?= BASE_URL; ?>/products/edit-product.php" class="btn btn-warning">Edit</a>
    <?php } ?>
  </div>
<?php
  include "../partials/footer.html";
