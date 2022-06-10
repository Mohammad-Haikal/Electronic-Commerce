<?php
include('./templates/PHPScripts.php');

if (!User::check()) {
    header("location: ./login");
}

$orders = Order::viewOrders($_SESSION['user_id']);

if (isset($_POST['deleteOrder'])) {
    Order::delete($_POST['orderId']);
}

?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->

    <div class="container py-3">
        <?php echo $error; ?>
        <?php echo $success; ?>

        <h3 class="mb-0">My Orders</h3>
        <hr class="myCustomHr">
        <div style="width: 100%; overflow-x: auto;" class="mb-3">
            <table class="table table-striped table-hover">
                <?php if (!empty($orders)) : ?>
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Address</th>
                            <th>Street</th>
                            <th>Building No.</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?= $order['token'] ?></td>
                                <td><?= $order['address'] ?></td>
                                <td><?= $order['street_name'] ?></td>
                                <td><?= $order['building_number'] ?></td>
                                <td><?= $order['name'] ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td><small class="price"><?= $order['price'] ?> JOD</small></td>
                                <td><?= $order['status'] ?></td>
                                <td><?= date("Y/m/d", strtotime($order['created_at'])) ?></td>
                            </tr>

                        <?php endforeach ?>
                </tbody>
            <?php else : ?>
                <p class="text-muted text-center">No orders found.</p>
            <?php endif ?>
            </table>
        </div>
    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>