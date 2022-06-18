<?php
include('./templates/PHPScripts.php');

if (!User::check() && !Admin::check()) {
    header("location: ./login.php");
} elseif (Admin::check()) {
    $user = Admin::getAdmin()[0];
} else {
    $user = User::getUser()[0];
}


if (isset($_POST['updatePersonalInfo'])) {
    User::updatePersonalInfo($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["phone"]);
}

if (isset($_POST['updatePassword'])) {
    User::updatePassword($_POST["oldPassword"], $_POST["password"], $_POST["passwordR"]);
}
?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>

    <div class="container min-vh-100 d-flex flex-column align-items-center">
        <div class="p-4 col-md-9">
            <h4 class="mb-3">Update Personal Info</h4>
            <?php echo $error ?>
            <?php echo $success ?>
            <div class="card p-3 row">
                <!-- Form -->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">User id</label>
                            <input type="text" class="form-control disabled" disabled value="<?= $user['id'] ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Joined at</label>
                            <input type="text" class="form-control disabled" disabled value="<?= date("Y-m-d", strtotime($user['created_at'])); ?>">
                        </div>

                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" required name="first_name" value="<?= $user['first_name'] ?>">
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" required name="last_name" value="<?= $user['last_name'] ?>">
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Email address</label>
                            <input type="email" class="form-control" required name="email" value="<?= $user['email'] ?>">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="address2" class="form-label">Phone number</label>
                            <input type="text" class="form-control" required name="phone" value="<?= $user['phone'] ?>">
                        </div>
                    </div>

                    <button  class="w-100 btn myFilledCustomBtn2" name="updatePersonalInfo" type="submit">Confirm</button>
                </form>
            </div>
        </div>


        <div class="p-4 col-md-9">
            <h4 class="mb-3">Update Password</h4>
            <div class="card p-3 row">
                <!-- Form -->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="address2" class="form-label">Your old password</label>
                            <input type="password" class="form-control" required name="oldPassword">
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">New password</label>
                            <input type="password" class="form-control" required name="password">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="address2" class="form-label">Re-enter new password</label>
                            <input type="password" class="form-control" required name="passwordR">
                        </div>
                    </div>

                    <button  class="w-100 btn myFilledCustomBtn2" name="updatePassword" type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>


    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>