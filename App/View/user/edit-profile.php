<?php
  $title = "Edit Profile";
  $active = "profile";
  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../partials/head.html";
  include "../partials/header.html";
  $user = [
    'email'=>'example@domain.com',
    'first_name' => 'John',
    'last_name' => 'Doe'
  ];
?>
  <div class="py-5 container">
    <div class="d-flex">
      <div class="col-lg-6 col-md-10 col-12 mx-auto">
        <form action="" method="post" class="d-flex flex-column">
          <div class="mb-3 d-flex flex-column">
            <img src="https://picsum.photos/400/400" class="img-thumbnail mb-2" alt="User Profile Picture"/>
            <div class="btn btn-warning">
              Upload
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input value="<?= $user['first_name'];?>" name="first_name" placeholder="John" id="first_name" type="text" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input value="<?= $user['last_name'];?>" name="last_name" placeholder="Doe" id="last_name" type="text" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="<?= $user['email'];?>" name="email" placeholder="example@domain.com" id="email" type="email" class="form-control">
          </div>
          <div class="d-flex mb-3 align-items-center justify-content-center">
            <button class="btn btn-primary me-3">Update</button>
            <a href="<?= BASE_URL;?>/user/view-profile.php">
              <div class="btn btn-danger mx-auto">Cancel</div>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
  include "../partials/footer.html";
