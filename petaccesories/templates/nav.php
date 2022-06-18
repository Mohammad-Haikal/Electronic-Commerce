<?php 
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid px-md-3 px-lg-5">
        <a class="navbar-brand" href="index.php">
            <img src="./img/logo.png" class="mx-1 " style="width: 35px; height: 35px;" alt="Logo">
            Pets Accessories
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'index.php') {echo "active";}?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'about.php') {echo "active";}?>" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'store.php') {echo "active";}?>" href="store.php">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'gallery.php') {echo "active";}?>" href="gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'contact.php') {echo "active";}?>" href="contact.php">Contact Us</a>
                </li>   
            </ul>

            

            <?php if (User::check()) : ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo User::getUserFullName() ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php if (Admin::check()) : ?>
                                <li><a class="dropdown-item" href="dashboard.php">Admin Dashboard</a></li>
                            <?php endif; ?>

                            <li><a class="dropdown-item <?php if ($currentPage == 'orders.php') {echo "myFilledCustomBtn2";}?>" href="orders.php">Orders</a></li>
                            <li><a class="dropdown-item <?php if ($currentPage == 'account.php') {echo "myFilledCustomBtn2";}?>" href="account.php">Account Settings</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>

            <?php else : ?>
                <div class="d-flex justify-content-md-end ms-auto">
                    <a class="btn btn-sm myCustomBtn" href="login.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Login
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!-- Navbar -->