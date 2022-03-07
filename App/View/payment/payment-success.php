<?php
  $title = "Payment Success";
  $active = "payment";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
?>
  <div class="p-5 container">
    <div class="alert alert-success d-flex align-items-center" role="alert">
      <i class="fa fa-check-circle me-2"></i>
      <div>
        Thank you for purchasing our product
      </div>
    </div>
  </div>
<?php
  include "../partials/footer.html";

