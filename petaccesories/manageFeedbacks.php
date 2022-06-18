<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login.php");
}

$feedbacks = Feedback::viewAll();

if (isset($_POST['deleteFeedback'])) {
    Feedback::delete($_POST['feedbackId']);
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

        <h3 class="mb-0">Manage Feedbacks</h3>
        <hr class="myCustomHr">

        <div style="width: 100%; overflow-x: auto;" class="mb-3">
            <table class="table table-striped table-hover">
                <?php if (!empty($feedbacks)) : ?>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feedbacks as $feedback) : ?>
                            <tr>
                                <td><?= User::getUserNameById($feedback['user_id']) ?></td>
                                <td><?= $feedback['feedback'] ?></td>
                                <td>
                                    <form style="width: fit-content;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="text" name="feedbackId" value="<?= $feedback['id'] ?>" hidden>
                                        <button name="deleteFeedback" onclick="return confirm('Are you sure to delete this feedback?')" type="submit" class="link-danger bg-transparent border-0">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                <?php else : ?>
                    <p class="text-muted text-center">No feedbacks found.</p>
                <?php endif ?>
            </table>
        </div>
    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>