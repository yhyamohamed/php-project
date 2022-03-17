<?php

session_start();
require_once '../../vendor/autoload.php';
use App\Utilities\Helper;
if (!isset($_SESSION['user_id'])) {
  Helper::redirect("Location:login.php");
}
use App\Controllers\ProductController;
use App\Controllers\OrderController;

$pc = new ProductController;
$orderController = new OrderController;
$product_id = 1;
if ($_SERVER['REQUEST_METHOD'] === "GET")
{
    if (count($_GET) > 0)
    {
        if (isset($_GET["product_id"]))
        {
            $product_id = intval($_GET["product_id"]);
            // $order = $orderController->create($_SESSION["user_id"], $product_id);
        }
    }
}


$product = $pc->showDetails($product_id);
$link_token = $product->download_file_link;
$path = "../products/download.php?file=";

$url = $path . $link_token;
$oc = new OrderController;
$download_count = $oc->getDownloadCount($_SESSION["user_id"]) ?? 1;


$title = 'Download';
$active = 'download';


  include "includes/head.html";
  include "includes/header.html";
?>

    <div class="d-flex justify-content-center align-items-center h-100 py-5">
        <div class="card mb-3" style="max-width: 800px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="assets/images/music-thumb.jpg" class="img-fluid m-2" alt="Theme preview">
                </div>
                <div class="col-md-8">
                    <div class="card-body m-1">
                        <h3 class="card-title"><?= $product->product_name ?></h3>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur blanditiis consectetur, culpa debitis dicta dolorem eaque eligendi eveniet explicabo fuga harum obcaecati officiis pariatur quam quis ratione similique, voluptatum!</p>

                        <?php if ($download_count == 7)
                        { ?>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-0 lead text-danger">Download count: <span class="h4 fw-bold"><?php echo "$download_count" ?> !!</span></p>
                                <a href="buyagain.php" class="btn btn-warning m-1 px-5" type="button">Buy Again</a>
                            </div>
                        <?php }
                        else
                        { ?>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-0 lead">Download count: <span class="h4 fw-bold"><?php echo "$download_count" ?></span></p>
                                <a href="<?php echo $url; ?>" class="btn btn-success m-1 px-5" type="button" id="download">Download</a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <br><br>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Show Details...
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto asperiores commodi cum deleniti fugit quisquam similique vero. Alias amet at dolor enim exercitationem magni quae quasi sunt unde voluptates. Repudiandae.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!--    <script>-->
<!--        $("#download").click((e) => {-->
<!--            setTimeout(() => {-->
<!--                location.reload();-->
<!--                return false;-->
<!--            }, 500);-->
<!--        });-->
<!--    </script>-->

<?php
  include "includes/footer.html";
