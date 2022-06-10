<?php
session_start();

//addToCart
if (isset($_POST['addCartItem'])) {
    $inpttedQuantity = $_POST['quantity'];
    $inpttedProductId = $_POST['product_id'];

    $key = array_search($inpttedProductId, array_column($_SESSION['cart'], 'product_id'));

    $productStock = $_SESSION['cart'][$key]['stock'];
    $productQuantity = $_SESSION['cart'][$key]['quantity'];

    if (($productQuantity + $inpttedQuantity) > $productStock) {
        echo json_encode(array("error" => true, "stock" => $productStock));
    } else {
        $_SESSION['cart'][$key]['quantity'] += $inpttedQuantity;
        echo json_encode($_SESSION['cart']);
    }
}


if (isset($_POST['deleteCartItem'])) {
    $key = array_search($_POST['product_id'], array_column($_SESSION['cart'], 'product_id'));
    $_SESSION['cart'][$key]['quantity'] = 0;
    header("location: ../../cart?success= Item deleted successfully!");
}
