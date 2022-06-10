<?php
include('./templates/PHPScripts.php');
$images = Product::getAllImages();
?>

<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body class="bg-light">
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->
    <?php echo $success ?>

    <div class="container py-3">
        <section class="p-2 pb-1 text-center d-flex flex-column align-items-center">
            <h2>Our Gallery</h2>
            <hr class="col-10 col-sm-3 mt-0 myCustomHr">
        </section>
        <section class="row g-2 mb-5 justify-content-center">
            <?php foreach ($images as $image) : ?>
                <img src="<?= $image['image'] ?>" class="image myCustomImg shadow" style="width: 250px; height: 180px;">
            <?php endforeach ?>
        </section>
        <style>
            .image{
                transition-duration: 0.2s;
            }
            .image:hover {
                z-index: 1;
                -ms-transform: scale(1.1);
                /* IE 9 */
                -webkit-transform: scale(1.1);
                /* Safari 3-8 */
                transform: scale(1.1);
            }
        </style>

    </div>

    <!-- Footer -->
    <?php include('./templates/footer.php') ?>
    <!-- Footer -->

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>