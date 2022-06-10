<?php
session_start();

// Unset all of the session variables.
unset($_SESSION['user_id']);
unset($_SESSION['admin_id']);
unset($_SESSION['cart']);
// 
// 

// session_destroy();

header("location: ./index");
