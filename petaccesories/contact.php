<?php
include('./templates/PHPScripts.php')
?>

<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body class="bg-light">
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->
    <?php echo $success ?>

    <div class="container p-3">

        <section class="p-2 pb-1 text-center d-flex flex-column align-items-center">
            <h2>SEND US A MESSAGE</h2>
            <hr class="col-10 col-sm-3 mt-0 myCustomHr">
        </section>


        <!-- Form -->
        <!-- <form method="get" action=""> -->
            <div class="rounded bg-white border border-2 my-3 col-md-12 p-3 row g-0">
                <div class="form-floating mb-3 col-md-12">
                    <input type="email" class="form-control" id="floatingInput" placeholder="...">
                    <label for="floatingInput">Full Name</label>
                </div>
                <div class="form-floating mb-3 col-md-12">
                    <input type="email" class="form-control" id="floatingInput" placeholder="...">
                    <label for="floatingInput">Phone number (optional)</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Your Email address</label>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone.</div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Your message here" style="height: 100px"></textarea>
                    <label for="floatingTextarea">Your Message</label>
                </div>
                <a type="submit" class="btn myCustomBtn" href="contact.php?success=Your message has been sent to the admin">Send Message</a>
            </div>
        <!-- </form> -->
    </div>

    <!-- Footer -->
    <?php include('./templates/footer.php') ?>
    <!-- Footer -->

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>