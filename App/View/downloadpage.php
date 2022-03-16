<?php

session_start();
require_once '../../vendor/autoload.php';

use App\Controllers\ProductController;
use App\Controllers\OrderController;

$pc = new ProductController;
$link_token = $pc->showDetails(1)->download_file_link;
$path = "../products/download.php?file=";

$url = $path . $link_token;
$oc = new OrderController;
$download_count = $oc->getDownloadCount($_SESSION["user_id"]) ?? 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

    <title>Download Page</title>
</head>

<body style="height:100vh;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card mb-3" style="max-width: 800px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="assets/images/music-thumb.jpg" class="img-fluid m-2" alt="Theme preview">
                </div>
                <div class="col-md-8">
                    <div class="card-body m-1">
                        <h3 class="card-title">Card title</h3>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>

                        <?php if ($download_count == 7)
                        { ?>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-0 lead text-danger">Download count: <span class="h4 fw-bold"><?php echo "$download_count" ?> !!</span></p>
                                <a href="buyagain.php" class="btn btn-primary m-1 px-5" type="button">Buy Again</a>
                            </div>
                        <?php }
                        else
                        { ?>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-0 lead">Download count: <span class="h4 fw-bold"><?php echo "$download_count" ?></span></p>
                                <a href="<?php echo $url; ?>" class="btn btn-primary m-1 px-5" type="button">Download</a>
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
                                <strong>This is the first item's accordion body.</strong> It
                                is shown by default, until the collapse plugin adds the
                                appropriate classes that we use to style each element. These
                                classes control the overall appearance, as well as the showing
                                and hiding via CSS transitions. You can modify any of this
                                with custom CSS or overriding our default variables. It's also
                                worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit
                                overflow.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>