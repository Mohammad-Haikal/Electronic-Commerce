<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./sass/root.css">
    <title>Pet Accessories</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container-fluid pe-md-5 ps-md-5">
            <a class="navbar-brand" href="#">Pet Accessories</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="store.html">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.html">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contct Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Mohammad Haikal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <div class="container">
        <h4 class="mt-3 text-center">Create a New Account</h4>
        <hr class="col-12 myCustomHr">
        <div class="card mt-3 p-3 row">
            <form>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Email Address</label>
                        <input type="email" class="form-control" placeholder="name@example.com" required>
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Phone number</label>
                        <input type="text" class="form-control" required>
                    </div>
                    
                    <div class="col-12">
                        <label for="address2" class="form-label">Password</label>
                        <input type="password" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Re-enter Password</label>
                        <input type="password" class="form-control" required>
                    </div>
                </div>

                <hr class="my-4"> 
                
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" required> 
                    <label class="form-check-label">I agree to the <a class="link-primary text-decoration-underline" target="_blank" href="./about.html#termsConditions">Terms & Conditions</a></label>
                </div>
                <button id="onlinePayBtn" class="w-100 myFilledCustomBtn btn-lg" type="submit">Sign up</button>
            </form>
        </div>
        <div class="card mt-3 mb-3 p-4 col-md-12 row">
            <p class="text-center m-0">Have an account? <a class="link-primary text-decoration-underline" href="./login.html">Log in</a></p>
        </div>
    </div>


    

    <!-- Footer -->
    <footer class="d-flex flex-column flex-md-row  p-5">
        <div class="col-12 col-md-3 p-3">
            <h3>Pet Accessories</h3>
            <p style="text-align: justify;">A store that online sells different kinds of pet accessories and supplies
                including: food, treats,
                toys, collars, leashes, cat litter, cages, and aquariums.</p>
        </div>
        <div class="col-12 col-md-2 p-3">
            <h3>WEB LINKS</h3>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="index.html">Home</a></li>
                <li class="nav-item"><a href="about.html">About</a></li>
                <li class="nav-item"><a href="store.html">Store</a></li>
                <li class="nav-item"><a href="gallery.html">Gallery</a></li>
                <li class="nav-item"><a href="contact.html">Contct Us</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-3 p-3">
            <h3>GET IN TOUCH</h3>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#">Jordan - Amman, Irbid, Zarqa'</a></li>
                <li class="nav-item"><a href="#">+962790580502</a></li>
                <li class="nav-item"><a href="#">@petaccessories</a></li>
            </ul>
        </div>
        <div class="flex-grow-1 p-3">
            <h3>PHOTOS</h3>
            <div class="d-flex flex-wrap">
                <img class="animalSmall m-1" src="./img/products/1.jpg" alt="animal">
                <img class="animalSmall m-1" src="./img/products/2.jpg" alt="animal">
                <img class="animalSmall m-1" src="./img/products/3.jpg" alt="animal">
                <img class="animalSmall m-1" src="./img/products/4.jpg" alt="animal">
                <img class="animalSmall m-1" src="./img/products/5.jpg" alt="animal">
                <img class="animalSmall m-1" src="./img/products/6.jpg" alt="animal">
            </div>
        </div>
    </footer>
    <!-- Footer -->


    <!-- Scripts -->
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./jquery/jquery.js"></script>
    <script src="./jquery/jquery-ui.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>