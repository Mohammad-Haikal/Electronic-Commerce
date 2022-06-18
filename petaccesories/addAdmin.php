<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login.php");
}

if (isset($_POST['addAdmin'])) {
    Admin::addAdmin($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["phone"], $_POST["password"], $_POST["passwordR"]);
}
?>

<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">

    <div class="container min-vh-100 col-md-7">
        <h4 class="mt-3 text-center">Add New Admin</h4>
        <hr class="col-12 myCustomHr">

        <div class="card mt-3 p-3 row">
            <!-- form -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <?php echo $error ?>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Phone number</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" id="password" class="form-control " name="password" required>
                            <i class="fs-5 bi bi-eye-slash position-absolute d-flex align-items-center" style="top: 50%; left: 95%; transform: translate(-50%, -50%);" id="togglePassword"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="text-muted">Your Password must:</h5>
                        <ul>
                            <li class="text-muted">be a minimum of 8 characters.</li>
                            <li class="text-muted">contain at least 1 number.</li>
                            <li class="text-muted">contain at least 1 uppercase character.</li>
                            <li class="text-muted">contain at least 1 lowercase character.</li>
                            <li class="text-muted">contain at least 1 special character.</li>
                        </ul>
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Re-enter Password</label>
                        <div class="position-relative">
                            <input type="password" id="passwordR" class="form-control " name="passwordR" required>
                            <i class="fs-5 bi bi-eye-slash position-absolute d-flex align-items-center" style="top: 50%; left: 95%; transform: translate(-50%, -50%);" id="togglePasswordR"></i>
                        </div>
                    </div>
                    <script>
                        let password = document.getElementById("password");
                        let passwordR = document.getElementById("passwordR");
                        $("#togglePassword").click(function(e) {
                            const typee = password.type === 'password' ? 'text' : 'password';
                            password.type = typee;
                            this.classList.toggle('bi-eye');
                        });
                        $("#togglePasswordR").click(function(e) {
                            const typee = passwordR.type === 'password' ? 'text' : 'password';
                            passwordR.type = typee;
                            this.classList.toggle('bi-eye');
                        });
                    </script>
                </div>

                <button class="w-100 myFilledCustomBtn2 btn-lg border-0" name="addAdmin" type="submit">Add Admin</button>
            </form>
        </div>
    </div>


    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>