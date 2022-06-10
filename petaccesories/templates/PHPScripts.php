<?php
session_start();

include('./Modules/DB.php');
include('./Modules/Visitor.php');
include('./Modules/User.php');
include('./Modules/Admin.php');
include('./modules/Category.php');
include('./modules/Brand.php');
include('./Modules/Product.php');
include('./Modules/Order.php');
include('./Modules/Comment.php');
include('./Modules/Rating.php');
include('./Modules/Feedback.php');

$error = (isset($_GET['error'])) ? "<div id='errorAlert' class='alert alert-danger' role='alert'><button type='button' class='btn-close me-3 align-middle' aria-label='Close'></button>{$_GET['error']}</div>": "";
$success = (isset($_GET['success'])) ? "<div id='successAlert' class='alert alert-success' role='alert'><button type='button' class='btn-close me-3 align-middle' aria-label='Close'></button>{$_GET['success']}</div>": "";

?>