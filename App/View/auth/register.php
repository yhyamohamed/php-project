<?php
  $title = "Register";
  $active = "register";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
?>
<div class="py-5 container">
  <div class="d-flex">
    <div class="col-lg-6 col-md-10 col-12 mx-auto">
      <form action="<?= BASE_URL; ?>" method="post" class="d-flex flex-column">
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" placeholder="example@domain.com" id="email" type="email" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" placeholder="***" id="password" type="password" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input name="confirm_password" placeholder="***" id="confirm_password" type="password" class="form-control">
        </div>
        <button class="btn btn-primary mx-auto mb-3">Register</button>
        <p class="text-center">Have an account? <a href="<?= BASE_URL; ?>/auth/login.php">Login</a></p>
      </form>
    </div>
  </div>
</div>
<?php
  include "../partials/footer.html";
