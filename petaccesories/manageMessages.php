<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login");
}

$messages = Message::viewAll();

if (isset($_POST['deleteMessage'])) {
    Message::delete($_POST['messageId']);
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

        <h3 class="mb-0">Manage Messages</h3>
        <hr class="myCustomHr">

        <div style="width: 100%; overflow-x: auto;" class="mb-3">
            <table class="table table-striped table-hover">
                <?php if (!empty($messages)) : ?>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message) : ?>
                            <tr>
                                <td><?= $message['name'] ?></td>
                                <td><?= $message['phone'] ?></td>
                                <td><?= $message['email'] ?></td>
                                <td><?= $message['message'] ?></td>
                                <td>
                                    <form style="width: fit-content;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="text" name="messageId" value="<?= $message['id'] ?>" hidden>
                                        <button name="deleteMessage" onclick="return confirm('Are you sure to delete this message?')" type="submit" class="link-danger bg-transparent border-0">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                <?php else : ?>
                    <p class="text-muted text-center">No Messages found.</p>
                <?php endif ?>
            </table>
        </div>
    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>