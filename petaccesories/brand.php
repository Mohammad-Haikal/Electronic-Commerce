<?php
include('./templates/PHPScripts.php');
$brand = brand::getBrand($_GET['brandId'])[0];
$products = Product::viewSupplierProducts($_GET['brandId']);
$brandRatingInfo = Rating::getBrandRatingInfo($_GET['brandId']);
$rating = $brandRatingInfo['rating'];
$numOfRaters = $brandRatingInfo['num_of_raters'];
?>

<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->

    <?php echo $error ?>
    <?php echo $success ?>

    <div class="row g-0 pt-3 bg-light">
        <div class="col-md-3 px-3 ">
            <h2 class="mb-2"><?= Brand::getBrandName($_GET['brandId']) ?></h2>
            <div class="mb-5">
                <h5>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i < $rating + 1) {
                            echo "<i class='bi bi-star-fill'></i> ";
                        } else {
                            echo "<i class='bi bi-star'></i> ";
                        }
                    }
                    echo "<small class='text-muted'>( $numOfRaters )</small>";
                    ?>
                </h5>
                <h5>Email: <br><a class="link-primary" href="mailto:<?= $brand['email'] ?>"><?= $brand['email'] ?></a></h5>
                <h5>Website: <br><a class="link-primary" href="<?= $brand['website'] ?>"><?= $brand['website'] ?></a></h5>
                <h5>
                    Rate:
                    <form class="d-inline" id="rateForm" name="rateForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <input id="rate<?= $i ?>" type="radio" name="rate" value="<?= $i ?>" onclick="submitRate(<?= $brand['id'] ?>, value)" hidden>
                            <label for="rate<?= $i ?>"><i id="star<?= $i ?>" class='bi bi-star' style='cursor: pointer;'></i></label>
                        <?php endfor ?>
                    </form>
                </h5>
                <style>
                    .bi-star-fill {
                        color: #FCA311;
                    }
                </style>
                <script>
                    function submitRate(brandId, value) {
                        for (let i = 1; i <= 5; i++) {
                            if (i <= parseInt(value)) {
                                $(`#star${i}`).addClass("bi-star-fill");

                            } else {
                                if ($(`#star${i}`).hasClass("bi-star-fill")) {
                                    $(`#star${i}`).removeClass("bi-star-fill");
                                }
                            }
                        }

                        $.ajax({
                            type: "post",
                            url: "./modules/ajax/rate.php",
                            data: {
                                "brandId": brandId,
                                "rate": value
                            },
                            success: function(response) {
                                console.log(parseInt(response));

                            }
                        });
                    }
                </script>


            </div>
        </div>
        <div class="col">
            <!-- Products -->
            <h3 class="">Supplier Products</h3>
            <hr class="m-0 mb-2 myCustomHr">
            <div id="productsSection" class="min-vh-100  justify-content-center align-items-start bg-white">
                <div class="row g-0 align-items-start p-2">
                    <?php foreach ($products as $product) : ?>
                        <!-- form -->
                        <div class="col-12 col-md-3 bg-white overflow-hidden p-1">
                            <img src="<?= $product['image'] ?>" class="categories mb-1 w-100" style="height: 12rem;">
                            <h5 class="text-truncate"><?= $product['name'] ?></h5>
                            <h6 class="price"><?= $product['price'] ?> JOD</h6>
                            <button class="btn myCustomBtn rounded-0 w-100 p-2" data-bs-toggle="modal" data-bs-target="#product<?= $product['id'] ?>">Product Details</button>

                            <!-- Modal -->
                            <div class="modal fade" id="product<?= $product['id'] ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="ModalLabel"><?= $product['name'] ?></h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <img src="<?= $product['image'] ?>" class="categories mb-3 w-100" style="max-height: 400px;">
                                            <h4 class="mb-1">About the product:</h4>
                                            <textarea class="myCustomText py-2 w-100 form-control mb-3 bg-light" style="text-align: justify;" rows="4" disabled><?= $product['description'] ?></textarea>
                                            <h6>Brand: <span class="price"><?= Brand::getBrandName($product['brand_id']) ?></span></h6>
                                            <h6>Category: <span class="price"><?= Category::getCategory($product['category_id']) ?></span></h6>
                                            <h6 class="mb-1">In Stock: <span class="price"><?= $product['quantity'] ?></span></h6>
                                            <h6 class="mb-1">sold: <span class="price"><?= $product['sold'] ?> times</span></h6>
                                            <h6 class="mb-1">Price: <span class="price"><?= $product['price'] ?> JOD</span></h6>
                                            <hr class="col-5">
                                            <p class="mb-1 text-muted">Added On <span><?= date("Y-m-d", strtotime($product['created_at'])); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <!-- Products -->
        </div>





    </div>




    <!-- Footer -->
    <?php include('./templates/footer.php') ?>
    <!-- Footer -->

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>