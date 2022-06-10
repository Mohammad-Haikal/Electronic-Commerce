<?php
include('../DB.php');
include('../Rating.php');

if (isset($_POST['rate'])) {
    Rating::rate($_POST['brandId'], $_POST['rate']);
}
