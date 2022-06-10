<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login");
}

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
        <div class="row g-0">
            <!-- Visitors -->
            <div class="card m-2 " style="width: fit-content;">
                <h3 class="card-header border-0">Total Visitors</h3>
                <h4 class="card-body text-muted"><?= Visitor::getVisitorsNumber(); ?> <small>Visitors</small></h4>
            </div>
            <!-- Visitors -->

           <!-- Top Sold Product -->
           <div class="card m-2 " style="width: fit-content;">
                <h3 class="card-header border-0">Top Sold Product</h3>
                <h4 class="card-body text-muted">Dog's Bed</h4>
            </div>
            <!-- Top Sold Product -->

        </div>



    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>