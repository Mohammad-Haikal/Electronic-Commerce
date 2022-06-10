<?php
include('./templates/PHPScripts.php');

if (isset($_POST['login'])) {
    User::login($_POST["email"], $_POST["password"]);
}

?>

<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->

    <div class="container min-vh-100 col-md-7">
        <h4 class="mt-3 text-center">Log In</h4>
        <hr class="col-12 myCustomHr">
        <div class="card mt-3 p-3 row">
            <!-- Form -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <?php echo $error; ?>
                <?php echo $success; ?>

                <div class="row g-0 p-2">
                    <div class="col-12 mb-2">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" id="password" class="form-control " name="password" required>
                            <i class="fs-5 bi bi-eye-slash position-absolute d-flex align-items-center" style="top: 50%; left: 95%; transform: translate(-50%, -50%);" id="togglePassword"></i>
                        </div>
                    </div>
                    <script>
                        let password = document.getElementById("password");
                        $("#togglePassword").click(function(e) {
                            const typee = password.type === 'password' ? 'text' : 'password';
                            password.type = typee;
                            this.classList.toggle('bi-eye');
                        });
                    </script>
                </div>

                <button class="w-100 myFilledCustomBtn btn-lg border-0" name="login" type="submit">Log In</button>
            </form>
        </div>
        <div class="card my-3 p-4 col-12">
            <p class="text-center m-0">Don't have an account? <a class="myCustomText text-decoration-underline" href="./signup.php">Sign up</a></p>
        </div>
    </div>




    <!-- Footer -->
    <?php include('./templates/footer.php') ?>
    <!-- Footer -->

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>