<?php
  $title = "Payment";
  $active = "payment";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
  $isLoggedIn = isset($_SESSION['userId']);
?>
  <div class="p-5 container">
    <div class="col-lg-6 col-md-8 col-12 mx-auto">
      <form action="<?= BASE_URL;?>/payment/payment-success.php" method="post">
        <?php if (!$isLoggedIn) { ?>
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input placeholder="example@domain.com" type="email" id="email" class="form-control" name="email">
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" placeholder="***" id="password" type="password" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input name="confirm_password" placeholder="***" id="confirm_password" type="password" class="form-control">
        </div>
        <?php } ?>
        <div class="form-group mb-3">
          <div class="row align-items-end">
            <div class="col-8">
              <label for="name" class="form-label">Name on card</label>
              <input placeholder="John Doe" type="text" id="name" class="form-control" name="name">
            </div>
            <div class="col-4">
              <p>Expiration Date</p>
              <div class="row">
                <div class="col-6">
                  <label for="month">MM</label>
                  <input placeholder="XX" type="text" id="month" class="form-control numbers-only-input" name="month">
                </div>
                <div class="col-6">
                  <label for="year">YY</label>
                  <input placeholder="XX" type="text" id="year" class="form-control numbers-only-input" name="year">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group mb-3">
          <div class="row">
            <div class="col-9">
              <label for="credit" class="form-label">Credit Card</label>
              <input placeholder="XXXX-XXXX-XXXX-XXXX" type="text" id="credit" class="form-control numbers-only-input" name="credit">
            </div>
            <div class="col-3">
              <label for="cvv" class="form-label">CVV</label>
              <input placeholder="XXX" type="text" id="cvv" class="form-control numbers-only-input" name="cvv">
            </div>
          </div>
        </div>
        <button class="btn btn-success mx-auto mb-3">
          <i class="fa fa-dollar"></i>&nbsp;&nbsp;
          Pay
        </button>
      </form>
    </div>
  </div>
<?php
  include "../partials/footer.html";
