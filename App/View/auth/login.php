<?php
  $title = "Login";
  $active = "login";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
?>
<div class="py-5 container">
  <div class="d-flex">
    <div class="col-lg-6 col-md-10 col-12 mx-auto">
      <form action="<?= BASE_URL; ?>/" method="post" class="d-flex flex-column">
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" id="email" placeholder="example@domain.com" type="email" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" id="password" placeholder="***" type="password" class="form-control">
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me">
          <label class="form-check-label" for="remember_me">
            Remember me
          </label>
        </div>
        <button class="btn btn-primary mx-auto mb-3">Login</button>
        <p class="text-center">Don't have an account? <a href="<?= BASE_URL; ?>/auth/register.php">Create a new account</a></p>
      </form>
    </div>
  </div>
</div>
<?php
  include "../partials/footer.html";
