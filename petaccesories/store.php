<?php
include('./templates/PHPScripts.php');
$products = Product::viewAll();
$brands = Brand::viewAll();
$categories = Category::viewAll();


function getTotalItemsQuantity($items)
{
    $total = 0;
    foreach ($items as $item) {
        $total += $item['quantity'];
    }
    return $total;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();

    foreach ($products as $product) {
        array_push($_SESSION['cart'], ['product_id' => $product['id'], 'name' => $product['name'], 'price' => $product['price'], 'stock' => $product['quantity'], 'quantity' => 0,]);
    }
}


if (isset($_GET['search'])) {
    $products = Product::search($_GET['searchValue']);
}


if (isset($_GET['filter'])) {
    $min = $_GET['min'];
    $max = $_GET['max'];

    if (isset($_GET['brands'])) {
        $brads = implode(",", $_GET['brands']);
    } else {
        $brads = "";
    }

    if (isset($_GET['categories'])) {
        $cats = implode(",", $_GET['categories']);
    } else {
        $cats = "";
    }

    $products = Product::filter($min, $max, $brads, $cats);
}

if (!isset($min) || !isset($min)) {
    $min = 0;
    $max = 1000;
}

if (isset($_POST['addComment'])) {
    if (!User::check()) {
        header("location: ./login");
    }

    Comment::add($_SESSION['user_id'], $_POST['productId'], $_POST['comment']);
}

if (isset($_POST['deleteComment'])) {
    if (!User::check()) {
        header("location: ./login");
    }
    Comment::delete($_POST['commentId']);
}

if (isset($_POST['submitFeedback'])) {
    Feedback::add($_SESSION["user_id"], $_POST['feedback']);
}
?>

<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->

    <?php echo $error ?>
    <?php echo $success ?>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackLabel">Tell us about your experience!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="feedback" class="form-control w-100" rows="5" placeholder="Your experience here ..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submitFeedback" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Feedback Modal -->

    <div class="row g-0">
        <!-- Sidebar -->
        <section class="col-md-3 bg-light border-0">

            <!-- Cart -->
            <div class="card p-4 bg-light border-0">
                <a type="button" href="cart.php" class="myFilledCustomBtn text-center w-100 position-relative" style="padding: 8px !important;">
                    <span>View Cart</span>
                    <svg class="i-cart" viewBox="0 0 32 32" width="25" height="25" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M6 6 L30 6 27 19 9 19 M27 23 L10 23 5 2 2 2"></path>
                        <circle cx="25" cy="27" r="2"></circle>
                        <circle cx="12" cy="27" r="2"></circle>
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger" style="padding: 10px 12px 10px 12px;"><strong id="cartTotalItems"><?= getTotalItemsQuantity($_SESSION['cart']) ?></strong></span>
                </a>
            </div>
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <h4 class="ps-3">Filter By:</h4>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Price
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="From" name="min" value="<?= $min ?>" step="1" required>
                                    <span class="input-group-text" id="inputGroup-sizing-default">JOD</span>
                                    <input type="number" class="form-control" placeholder="To" name="max" value="<?= $max ?>" step="1" required>
                                    <span class="input-group-text " id="inputGroup-sizing-default">JOD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                Brand
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($brands as $brand) : ?>
                                        <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="brand<?= $brand['id'] ?>" name="brands[]" value="<?= $brand['id'] ?>">
                                                <label class="form-check-label" for="brand<?= $brand['id'] ?>"><?= $brand['name'] ?></label>
                                            </div>
                                            <span class="badge bg-light rounded-pill text-black"><?= Brand::getBrandCount($brand['id']) ?></span>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Category
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <?php foreach ($categories as $category) : ?>
                                    <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                                        <div class="d-inline">
                                            <input class="form-check-input me-1" type="checkbox" id="category<?= $category['id'] ?>" name="categories[]" value="<?= $category['id'] ?>">
                                            <label class="form-check-label" for="category<?= $category['id'] ?>"><?= $category['category'] ?></label>
                                        </div>
                                        <span class="badge bg-light rounded-pill text-black"><?= Category::getProductsCount($category['id']) ?></span>
                                    </li>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-1">
                    <input type="submit" class="btn myFilledCustomBtn2 col-12" name="filter" value="Filter">
                </div>

            </form>

            <?php if (isset($_GET['search']) || isset($_GET['filter']) || isset($_GET['filterOneCategory'])) : ?>
                <form class="" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <li class="list-group-item bg-light border-0 p-1">
                        <input type="submit" class="btn btn-outline-secondary text-center col-12" value="Cancel Filtering">
                    </li>
                </form>
            <?php endif ?>
            <!-- </ul> -->



        </section>

        <!-- Products -->
        <section id="productsSection" class="min-vh-100 col-md-9 justify-content-center align-items-start">
            <!-- Search Box -->
            <form class="col-md-9 input-group align-self-start p-3 bg-light border-0" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <input type="search" name="searchValue" class="form-control p-2" style="width:50%;" <?php if (isset($_GET['search'])) echo "value={$_GET['searchValue']}" ?> placeholder="Search Product">
                <input type="submit" name="search" class="form-control btn myFilledCustomBtn2 shadow-sm" style="width: fit-content;" value="Search">
            </form>
            <!-- Search Box -->

            <div class="row g-0 align-items-start p-2 overflow-auto" style="height: 100vh">
                <?php foreach ($products as $product) : ?>
                    <!-- form -->
                    <div class="col-12 col-md-3 bg-white overflow-hidden p-1">
                        <img src="<?= $product['image'] ?>" class="categories mb-1 w-100" style="height: 15rem;">
                        <h5 class="text-truncate"><?= $product['name'] ?></h5>
                        <h6 class="price"><?= $product['price'] ?> JOD</h6>
                        <button class="btn myCustomBtn rounded-0 w-100 p-2" data-bs-toggle="modal" data-bs-target="#product<?= $product['id'] ?>">Product Details</button>


                        <!-- Modal -->
                        <div class="modal fade" id="product<?= $product['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel"><?= $product['name'] ?></h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body row g-2">
                                        <img src="<?= $product['image'] ?>" class="categories col-md-6 mb-3" style="max-height: 400px;">
                                        <div class="col-md-6 ">
                                            <h4 class="mb-1">About the product:</h4>
                                            <textarea class="myCustomText py-2 w-100 form-control mb-2 border-0 bg-light" style="text-align: justify;" rows="4" disabled><?= $product['description'] ?></textarea>
                                            <h6>Brand: <a href="brand?brandId=<?= $product['brand_id'] ?>" class="price"><?= Brand::getBrandName($product['brand_id']) ?></a></h6>
                                            <h6>Category: <span class="price"><?= Category::getCategory($product['category_id']) ?></span></h6>
                                            <h6 class="mb-1">In Stock: <span class="price"><?= $product['quantity'] ?></span></h6>
                                            <h6 class="mb-1">sold: <span class="price"><?= $product['sold'] ?></span> times</h6>
                                            <h6 class="mb-1">Price: <span class="price"><?= $product['price'] ?> JOD</span></h6>
                                            <hr class="col-12">
                                            <p class="mb-1 text-muted">Added on <span><?= date("Y-m-d", strtotime($product['created_at'])); ?></span></p>
                                        </div>


                                        <!-- Comments -->
                                        <h2>Comments:</h2>
                                        <ul class="list-group list-group-flush " style="max-height: 300px; overflow-y: auto;">
                                            <?php
                                            $comments = Comment::getAllComments($product['id']);
                                            if (!empty($comments)) :
                                                foreach ($comments as $comment) : ?>
                                                    <li class="list-group-item">
                                                        <small class="text-muted"><?= $comment['user_first_name'] . " " . $comment['user_last_name'] ?></small>
                                                        <small class="ps-1 text-muted"><?= date("d/m/Y h:ia", strtotime($comment['created_at'])); ?></small>
                                                        <?php if ((Admin::check()) || (User::check() && $comment['user_id'] == $_SESSION['user_id'])) : ?>
                                                            <!-- Form -->
                                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-inline">
                                                                <input type="hidden" name="commentId" value="<?= $comment['id'] ?>" hidden>
                                                                <input type="submit" name="deleteComment" class="btn btn-sm link-danger" value="Delete">
                                                            </form>
                                                            <!-- Form -->
                                                        <?php endif ?>
                                                        <h5><?= $comment['comment'] ?></h5>

                                                    </li>
                                                <?php endforeach ?>
                                                <?php else:?>
                                                    <li class="list-group-item text-muted">
                                                     There are no comments yet.        
                                                    </li>
                                            <?php endif ?>

                                        </ul>
                                        <!-- Comments -->

                                        <!-- Form -->
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-light" name="comment" placeholder="Add comment" aria-label="Add comment" aria-describedby="commentBtn">
                                                <input type="text" name="productId" value="<?= $product['id'] ?>" hidden>
                                                <button class="btn myFilledCustomBtn2" name="addComment" type="submit" id="commentBtn">
                                                    Comment
                                                </button>
                                            </div>
                                        </form>
                                        <!-- Form -->


                                    </div>

                                    <div class="modal-footer">
                                        <div class="input-group" style="width: fit-content">
                                            <span class="input-group-text" id="quantitySpan">Quantity</span>
                                            <input type="number" class="form-control" id="quantity<?= $product['id'] ?>" style="width: 100px;" value="1" aria-describedby="quantitySpan">
                                        </div>
                                        <button type="button" class="btn myFilledCustomBtn" onclick="updateCart(<?= $product['id'] ?>, $('#quantity<?= $product['id'] ?>').val())" data-bs-dismiss="modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                            </svg>
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                <?php endforeach ?>
            </div>
        </section>

    </div>




    <!-- Footer -->
    <?php include('./templates/footer.php') ?>
    <!-- Footer -->

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <?php if (isset($_GET['ordered'])) : ?>
        <script>
            $(document).ready(function() {
                $('#feedback').modal("show");
            });
        </script>
    <?php endif ?>

    <!-- JS Scripts -->
</body>

</html>