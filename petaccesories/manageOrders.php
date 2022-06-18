<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login.php");
}

$orders = Order::viewAllOrders();

if (isset($_POST['deleteOrder'])) {
    Order::delete($_POST['orderId']);
}
?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/adminNav.php') ?>
    <!-- Navbar -->

    <div class="container py-3">
        <?php echo $error; ?>
        <?php echo $success; ?>

        <h3 class="mb-0">Manage Orders</h3>
        <hr class="myCustomHr">
        
        <div style="width: 100%; overflow-x: auto;" class="mb-3">
            <table class="table table-striped table-hover">
                <?php if (!empty($orders)) : ?>
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Full Name</th>
                            <th>Phone</th>
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
                                <td><?= $order['first_name'] . " " . $order['last_name'] ?></td>
                                <td><?= $order['phone'] ?></td>
                                <td><?= $order['address'] ?></td>
                                <td><?= $order['street_name'] ?></td>
                                <td><?= $order['building_number'] ?></td>
                                <td><?= $order['name'] ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td><small class="price"><?= $order['price'] ?> JOD</small></td>
                                <td><?= $order['status'] ?></td>
                                <td><?= date("Y/m/d", strtotime($order['created_at'])) ?></td>
                                <td>
                                    <form style="width: fit-content;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="text" name="orderId" value="<?= $order['id'] ?>" hidden>
                                        <button name="deleteOrder" onclick="return confirm('Are you sure to delete this order?')" type="submit" class="link-danger bg-transparent border-0">Delete</button>
                                    </form>
                                </td>
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