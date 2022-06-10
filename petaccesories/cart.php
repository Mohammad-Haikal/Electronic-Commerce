<?php
include('./templates/PHPScripts.php');

if (!User::check()) {
    header("location: ./login");
}


function getTotalPrice()
{
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }
    return $totalPrice;
}

if (isset($_POST['order'])) {
    Order::insert(User::getUser()[0]['id'], $_POST['orderStatusId'], $_POST['address'], $_POST['streetName'], $_POST['buildingNumber'], getTotalPrice());
}
?>



<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->

    <div class="container mb-5">
        <main>
            <div class="py-5 pb-2 text-center">
                <h2>Checkout</h2>
                <hr class="col-12 myCustomHr">
            </div>

            <div class="row">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h3 class="mb-3 price">Your cart</h3>
                    <?= $success ?>
                    <ul class="list-group mb-3">
                        <!-- Show Cart Items -->
                        <?php foreach ($_SESSION['cart'] as $item) : ?>
                            <?php if ($item['quantity'] != 0) : ?>
                                <li class="list-group-item lh-sm">
                                    <div>
                                        <h5 class="my-0"><?= $item['quantity'] ?></h5>
                                        <h6 class="my-0"><?= $item['name'] ?></h6>
                                    </div>
                                    <span class="text-muted mb-3"><?= $item['price'] ?> JOD</span>
                                    <div>
                                        <!-- Form -->
                                        <form method="post" action="./modules/ajax/updateCart.php">
                                            <input hidden type="text" name="product_id" value="<?= $item['product_id'] ?>">
                                            <button class="btn btn-sm btn-outline-danger" name="deleteCartItem">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endif ?>
                        <?php endforeach ?>

                        <li class="list-group-item d-flex justify-content-between myCustomBg">
                            <span>Total (JOD)</span>
                            <strong><?= getTotalPrice() ?> JOD</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <!-- Form -->
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="card p-3 mb-3">
                            <h3 class="class-body">Payment Method via:</h3>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderStatusId" id="orderStatusId1" value="1" onchange="paymentMethod(2)">
                                <label class="form-check-label" for="orderStatusId1">Cash on Delivery</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderStatusId" id="orderStatusId2" value="2" onchange="paymentMethod(1)" checked>
                                <label class="form-check-label" for="orderStatusId2">Credit Card</label>
                            </div>
                        </div>
                        <div id="cashDiv" class="card p-3">
                            <h4 class="mb-3">Billing address</h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <select class="form-select col-12" name="address" aria-label="Address" required>
                                        <option value="" selected>Choose one address</option>
                                        <option value="Amman">Amman</option>
                                        <option value="Irbid">Irbid</option>
                                        <option value="Zarqa">Zarqa</option>
                                        <option value="Mafraq">Mafraq</option>
                                        <option value="Ajloun">Ajloun</option>
                                        <option value="Jerash">Jerash</option>
                                        <option value="Madaba">Madaba</option>
                                        <option value="Balqa">Balqa</option>
                                        <option value="Karak">Karak</option>
                                        <option value="Tafileh">Tafileh</option>
                                        <option value="Maan">Maan</option>
                                        <option value="Aqaba">Aqaba</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Street name</label>
                                    <input type="text" class="form-control" name="streetName" required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Building number</label>
                                    <input type="text" class="form-control" name="buildingNumber" required>
                                </div>
                            </div>
                        </div>

                        <div id="onlineDiv" class="card p-3">
                            <h4 class="mb-3">Online Payment</h4>
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name on card</label>
                                    <input type="text" class="form-control" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Credit card number</label>
                                    <input type="text" class="form-control" required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Expiration</label>
                                    <input type="text" class="form-control" required>
                                </div>

                                <div class="col-6">
                                    <label for="cc-cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button  class="w-100 mt-3 btn myFilledCustomBtn btn-lg" name="order" type="submit">Continue to checkout</button>
                    </form>
                </div>

            </div>




        </main>
    </div>

    <!-- Footer -->
    <?php include('./templates/footer.php') ?>
    <!-- Footer -->

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>