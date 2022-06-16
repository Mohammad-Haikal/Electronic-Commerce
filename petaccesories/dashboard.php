<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login");
}
$topSoldProduct = Product::getTopSold();
?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/adminNav.php') ?>
    <!-- Navbar -->

    <div class="container">
        <?php echo $error; ?>
        <?php echo $success; ?>
        <div class="row g-0 justify-content-center">
            <!-- Visitors -->
            <div class="card m-2 col-md-5">
                <h3 class="card-header border-0">Total Visitors</h3>
                <h4 class="card-body text-muted"><?= Visitor::getVisitorsNumber(); ?> <small>visitor(s)</small></h4>
            </div>
            <!-- Visitors -->

            <!-- Total Users -->
            <div class="card m-2 col-md-5">
                <h3 class="card-header border-0">Total Users</h3>
                <h4 class="card-body text-muted"><?= User::totalUsers(); ?> <small>user(s)</small></h4>
            </div>
            <!-- Total Users -->

            <!-- Total Products -->
            <div class="card m-2 col-md-5">
                <h3 class="card-header border-0">Total products</h3>
                <h4 class="card-body text-muted"><?= Product::totalProducts(); ?> <small>product(s)</small></h4>
            </div>
            <!-- Total Products -->

            <!-- Top Sold Product -->
            <div class="card m-2 col-md-5">
                <h3 class="card-header border-0">Top Sold Product</h3>
                <h4 class="card-body text-muted"><?= $topSoldProduct['name'] . "<small> (" . $topSoldProduct['id'] . " times)</small> " ?></h4>
            </div>
            <!-- Top Sold Product -->

            <!-- Total Orders -->
            <div class="card m-2 col-md-5">
                <h3 class="card-header border-0">Total Orders</h3>
                <h4 class="card-body text-muted"><?= Order::totalOrders(); ?> <small>order(s)</small></h4>
            </div>
            <!-- Total Orders -->

            <!-- Total Products -->
            <div class="card m-2 col-md-5">
                <h3 class="card-header border-0">Total Sold products</h3>
                <h4 class="card-body text-muted"><?= Product::totalSoldProducts(); ?> <small>product(s)</small></h4>
            </div>
            <!-- Total Products -->

            

        </div>
    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>