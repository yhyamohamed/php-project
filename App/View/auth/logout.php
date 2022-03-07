<?php
  $title = "Logout";
  $active = "logout";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
?>
  <div class="p-5 container">
    <div class="alert alert-warning d-flex align-items-center" role="alert">
      Bye Bye
    </div>
  </div>
<?php
  include "../partials/footer.html";

