<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login.php");
}

$users = User::viewAllUsers();
$admins = Admin::getAllAdmins();

if (isset($_POST['deleteUser'])) {
    User::delete($_POST['userId']);
}

if (isset($_POST['deleteAdmin'])) {
    Admin::delete($_POST['adminId']);
}
?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/adminNav.php') ?>
    <!-- Navbar -->

    <div class="container mt-3">
        <?php echo $error; ?>
        <?php echo $success; ?>

        <h3 class="mb-0">Manage Users</h3>
        <hr class="myCustomHr">

        <div style="width: 100%; overflow-x: auto;" class="mb-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Joined At</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 0; ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <th><?= ++$i ?></th>
                            <td><?= $user['first_name'] . " " . $user['last_name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['phone'] ?></td>
                            <td><?= date("Y-m-d", strtotime($user['created_at'])) ?></td>
                            <td>
                                <form style="width: fit-content;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="text" name="userId" value="<?= $user['id'] ?>" hidden>
                                    <button name="deleteUser" onclick="return confirm('Are you sure to delete this user?')" type="submit" class="link-danger bg-transparent border-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>



        <div class="row g-0 justify-content-between align-items-center">
            <h3 class="mb-0" style="width: fit-content;">Manage Admins</h3>
            <a href="addAdmin.php" class="btn myFilledCustomBtn2" style="width: fit-content;">+ New Admin</a>
        </div>
        <hr class="myCustomHr">

        <div style="width: 100%; overflow-x: auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Joined At</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 0; ?>
                    <?php foreach ($admins as $admin) : ?>
                        <tr>
                            <th><?= ++$i ?></th>
                            <td><?= $admin['first_name'] . " " . $admin['last_name'] ?></td>
                            <td><?= $admin['email'] ?></td>
                            <td><?= $admin['phone'] ?></td>
                            <td><?= date("Y-m-d", strtotime($admin['created_at'])) ?></td>
                            <td>
                                <?php if ($admin['id'] != $_SESSION['admin_id']) : ?>
                                    <form style="width: fit-content;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="text" name="adminId" value="<?= $admin['id'] ?>" hidden>
                                        <button name="deleteAdmin" onclick="return confirm('Are you sure to delete this admin?')" type="submit" class="link-danger bg-transparent border-0">Delete</button>
                                    </form>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>