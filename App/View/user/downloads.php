<?php
  $title = "Product Details";
  $active = "products";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
  $downloads = [1,2];
?>
  <div class="p-5 container">
    <h1 class="mb-5 text-center">Downloads</h1>
    <?php if (count($downloads) === 0) { ?>
      <p class="lead">You have no downloads yet</p>
    <?php } else { ?>
      <div class="card card-body border mb-3">
        <div class="row">
          <div class="col-6">Product Name</div>
          <div class="col-3">Downloads Count</div>
          <div class="col-3">Action</div>
        </div>
      </div>
      <?php foreach ($downloads as $download) {?>
        <div class="card card-body border mb-3">
          <div class="row">
            <div class="col-6">Product Name</div>
            <div class="col-3">Downloads Count</div>
            <div class="col-3">
              <div class="btn btn-link">
                <i class="fa fa-cloud-download fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
     <?php }  } ?>
  </div>
<?php
  include "../partials/footer.html";
