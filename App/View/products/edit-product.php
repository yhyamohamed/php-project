<?php
  $title = "New Product";
  $active = "products";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
  $product = [
    'image' => 'https://picsum.photos/200/200',
    'name'=> 'product name',
    'description' => 'product description',
    'price' => '3'
  ];
?>
  <div class="p-5 container">
    <h1 class="mb-5 text-center">Edit product</h1>
    <div class="col-lg-6 col-md-8 col-12 mx-auto">
      <form action="<?= BASE_URL; ?>/products/single-product.php" method="post">
        <div class="d-flex mx-auto justify-content-center align-items-center flex-column mb-3 product-image-upload">
          <img src="<?= $product['image'];?>" class="img-thumbnail flex-grow-0 mb-2" alt="Product Image"/>
          <div class="btn btn-primary">
            Upload
          </div>
        </div>
        <div class="form-group mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input value="<?= $product['name']; ?>" type="text" name="name" id="name" placeholder="Documentation" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="description" class="form-label">Product Description</label>
          <textarea name="description" id="description" cols="30" class="form-control" placeholder="some extra text"><?= $product['description']; ?></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="price" class="form-label">Product Price</label>
          <input value="<?= $product['price']; ?>" type="text" name="price" id="price" placeholder="0" class="form-control numbers-only-input">
        </div>
        <button class="btn btn-success mx-auto d-block" type="submit">
          <i class="fa fa-edit me-1"></i>
          Edit
        </button>
      </form>
    </div>
  </div>
<?php
  include "../partials/footer.html";
