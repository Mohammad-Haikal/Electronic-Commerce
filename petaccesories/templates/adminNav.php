<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <div class="container-fluid pe-md-5 ps-md-5">
            <a class="navbar-brand" href="index.php">
                <!-- <img src="./img/logo.png" class="mx-1 " style="width: 40px; height: 40px;" alt="Logo"> -->
                Pets Accessories
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'dashboard.php') {echo "active";}?>" href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'manageUsers.php') {echo "active";}?>" href="./manageUsers.php">Manage Users</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'manageProducts.php') {echo "active";}?>" href="./manageProducts.php">Manage Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'manageOrders.php') {echo "active";}?>" href="./manageOrders.php">Manage Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'manageFeedbacks.php') {echo "active";}?>" href="./manageFeedbacks.php">Manage Feedbacks</a>
                    </li>

                </ul>

                <?php if (Admin::check()) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo Admin::getAdminFullName() ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item <?php if ($currentPage == 'account.php') {echo "myFilledCustomBtn2";}?>" href="account.php">Account Settings</a></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>

                <?php else : ?>
                    <div class="d-flex w-25">
                        <a class="btn myFilledCustomBtn w-100 text-center" href="login.php">
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