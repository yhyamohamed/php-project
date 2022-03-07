<?php
  $title = "Profile";
  $active = "profile";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
  $products = [1,2,3];
  $profile = true;
?>
<div class="p-5 container">
  <div class="row mb-3">
    <div class="col-3">
      <div class="d-flex flex-column">
        <img src="https://picsum.photos/400/400" class="img-thumbnail mb-2" alt="User Profile Picture"/>
        <div class="btn btn-warning">
          Upload
        </div>
      </div>
    </div>
    <div class="col-9">
      <h2>John Doe</h2>
      <p class="lead">example@domain.com</p>
      <p class="mb-2 lead">Products Count: 3</p>
      <a href="<?= BASE_URL;?>/user/edit-profile.php">
        <span class="btn btn-primary">
          Edit Profile
        </span>
      </a>
    </div>
  </div>
  <div class="row mb-3">
    <a href="<?= BASE_URL; ?>/products/new-product.php">
      <div class="btn btn-warning"><i class="fa fa-plus me-2"></i>Add new Product</div>
    </a>
  </div>
  <?php include "../partials/products-list.html"; ?>
</div>
<?php
  include "../partials/footer.html";
