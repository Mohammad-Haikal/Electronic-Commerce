<?php
include('./templates/PHPScripts.php');
Visitor::addVisitor();
?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/nav.php') ?>
    <!-- Navbar -->

    <!-- Welcome Hero -->
    <div class=" d-flex flex-column justify-content-center text-center p-1" style="height: 60vh">
        <!-- <img class="d-block mx-auto mb-4 bg-dark rounded-2" src="./img/logo.png" width="72" height="57"> -->
        <h1 class="fw-bold">Welcome to Pets Accessories</h1>
        <div>
            <p class="lead mb-4">Here you will find everything about your pets needs!</p>
            <a href="#carousel1" role="button" class="btn myCustomBtn">LET'S GET STARTED</a>
        </div>
    </div>
    <!-- Welcome Hero -->


    <div id="carousel1" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/slides/1.jpeg" class="d-block w-100 img-fluid" alt="1">
                <div class="carousel-caption d-none d-md-block row g-0 bg-black bg-opacity-25 p-3 rounded">
                    <h1 class="text-light">Welcome to Pets Accessories</h1>
                    <p class="text-light">Here you will find very interesting and helpful pets accessories!</p>
                <a href="./store.php" class="btn myFilledCustomBtn w-25">DISCOVER MORE</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./img/slides/2.jpeg" class="d-block w-100 img-fluid" alt="2">
                <div class="carousel-caption d-none d-md-block row g-0 bg-black bg-opacity-25 p-3 rounded">
                    <h1 class="text-light">Welcome to Pets Accessories</h1>
                    <p class="text-light">Here you will find very interesting and helpful pets accessories!</p>
                <a href="./store.php" class="btn myFilledCustomBtn w-25">DISCOVER MORE</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel -->

    <!-- Section -->
    <section class="d-flex flex-column flex-md-row justify-content-around p-2 pe-5 ps-5">
        <div class="text-center p-3">
            <img src="./img/icons/icons8-call-58.png" class="" style="width: 50px;" alt="phone">
            <h4>+962790580502</h4>
            <p>Round-the-clock hotline (24/7)</p>
        </div>
        <div class="text-center p-3">
            <img src="./img/icons/icons8-clock-100.png" class="" style="width: 50px;" alt="clock">
            <h4>OPENING HOURS</h4>
            <p>7 days a week from 9:00 am to 7:00 pm</p>
        </div>
        <div class="text-center p-3">
            <img src="./img/icons/icons8-instagram.svg" class="" style="width: 50px;" alt="instagram">
            <h4>@petaccessories</h4>
            <p>Follow us on instagram!</p>
        </div>
    </section>
    <!-- Section -->

    <!-- Section -->
    <section class="d-flex flex-row align-items-center p-5">
        <div class="d-none d-md-flex flex-wrap col-5">
            <img class="animal m-1" src="./img/products/1.jpg" alt="animal">
            <img class="animal m-1" src="./img/products/2.jpg" alt="animal">
            <img class="animal m-1" src="./img/products/3.jpg" alt="animal">
            <img class="animal m-1" src="./img/products/4.jpg" alt="animal">
            <img class="animal m-1" src="./img/products/5.jpg" alt="animal">
            <img class="animal m-1" src="./img/products/6.jpg" alt="animal">
        </div>
        <div class="col-12 col-md-6 flex-md-grow-1">
            <h1>A PET'S FAVORITE PLACE</h1>
            <hr class="col-5 myCustomHr">
            <p>Welcome to Pet Accessories Store, home to some of the world's most renowned international pet brands, we
                take great pride in curating collections of the best designer pet products and luxury pet accessories
                the world has to offer.</p>
        </div>
    </section>
    <!-- Section -->

    <!-- Section -->
    <section class="d-flex flex-column-reverse flex-md-row align-items-center justify-content-between p-5">
        <div class="col-12 col-md-7">
            <p>EVERYTHING YOU NEED FOR YOUR DEAR PET</p>
            <h2>FREE SHIPPING ON ALL ORDERS OVER $50</h2>
            <p>Our promise to pet owners is commitment, experience, and values built through years to build a better
                world for pets. Our Pet Advisors work at their best, to help you match your pet's needs to their breed,
                condition, age, or life stage and get the answers you need.</p>
        </div>
        <div>
            <img width="100%" src="./img/home1.jpg" alt="girl">
        </div>
    </section>
    <!-- Section -->

    <!-- Section -->
    <section class="d-flex flex-column justify-content-center p-5">
        <div class="bg-white d-flex flex-column-reverse flex-md-row justify-content-center align-items-center">
            <div class="sec6-content col-12 col-md-6 d-flex flex-column justify-content-center p-3 text-center align-items-center">
                <h1>DOGS</h1>
                <hr class="col-5 myCustomHr">
                <p>Have a new puppy at home? In our store, you can find everything you need for your puppy's new home
                    from puppy food to puppy toys!</p>
                <a href="./store.php" class="btn myCustomBtn">DISCOVER MORE</a>
            </div>
            <div class="col-12 col-md-6">
                <img width="100%" class="myCustomImg" style="max-height: 400px;" src="./img/Categories/dogs.jpg" alt="dogs">
            </div>
        </div>
        <div class="bg-white d-flex flex-column flex-md-row justify-content-center align-items-center">
            <div class="col-12 col-md-6">
                <img width="100%" class="myCustomImg" style="max-height: 400px;" src="./img/Categories/cats.jpg" alt="cats">
            </div>
            <div class="sec6-content col-12 col-md-6 d-flex flex-column justify-content-center p-3 text-center align-items-center">
                <h1>CATS</h1>
                <hr class="col-5 myCustomHr">
                <p>All you need for your kitten to settle into its new home under one roof: kitten beds and food, kitten
                    treats, kitten milk and toys, cat litter, and litter trays.</p>
                <a href="./store.php" class="btn myCustomBtn">DISCOVER MORE</a>
            </div>
        </div>
        <div class="bg-white d-flex flex-column-reverse flex-md-row justify-content-center align-items-center">
            <div class="sec6-content col-12 col-md-6 d-flex flex-column justify-content-center p-3 text-center align-items-center">
                <h1>BIRDS</h1>
                <hr class="col-5 myCustomHr">
                <p>Toys shouldn't be forgotten in a well-equipped cage; birds are highly intelligent and need activity
                    and variety to stimulate them. Here you'll find the appropriate toys for birds including parakeets,
                    large parakeets, and parrots.</p>
                <a href="./store.php" class="btn myCustomBtn">DISCOVER MORE</a>
            </div>
            <div class="col-12 col-md-6">
                <img width="100%" class="myCustomImg" style="max-height: 400px;" src="./img/Categories/birds.jpg" alt="birds">
            </div>
        </div>
    </section>
    <!-- Section -->




    <!-- Footer -->
    <?php include('./templates/footer.php') ?>
    <!-- Footer -->

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <script src="./js/carousel.js"></script>
    <!-- JS Scripts -->
</body>

</html>