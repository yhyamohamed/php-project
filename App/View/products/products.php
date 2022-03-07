<?php
  $title = "Products List";
  $active = "products";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
  $products = [1,2,3,4,5,6,7,8,9];
  $profile = false;
?>
<div class="py-5 container">
<?php include "../partials/products-list.html"; ?>
</div>
<?php
  include "../partials/footer.html";