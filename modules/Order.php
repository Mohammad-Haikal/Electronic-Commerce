<?php

class Order extends DB
{
  public static function insert($userId, $orderStatusId, $address, $streetName, $buildingNumber, $totalPrice)
  {

    $conn = self::connect();
    $userId = mysqli_real_escape_string($conn, htmlspecialchars($userId));
    $orderStatusId = mysqli_real_escape_string($conn, htmlspecialchars($orderStatusId));
    $address = mysqli_real_escape_string($conn, htmlspecialchars($address));
    $streetName = mysqli_real_escape_string($conn, htmlspecialchars($streetName));
    $buildingNumber = mysqli_real_escape_string($conn, htmlspecialchars($buildingNumber));
    $totalPrice = mysqli_real_escape_string($conn, htmlspecialchars($totalPrice));

    // Generate Token
    $token = $userId . time();

    // Prepare Order Products array
    $itemsArray = array();
    foreach ($_SESSION['cart'] as $item) {
      if ($item['quantity'] != 0) {

        // Call productSold method
        self::productSold($item['product_id'], $item['quantity']);

        $itemsValue = "({$token}, {$item['product_id']}, {$item['quantity']})";
        array_push($itemsArray, $itemsValue);
      }
    }
    $itemsArray = implode(", ", $itemsArray);

    // Check if itemsArray is empty, return to store.php with error message
    if (empty($itemsArray)) {
      $error = "Sorry, your cart is empty.";
      header("location: ./store?error=$error");
      exit;
    }

    // Insert Order
    self::insertQuery("INSERT INTO `order` (`user_id`, `token`, `order_status_id`, `address`, `street_name`, `building_number`, `total_price`) VALUES ('$userId', '$token', '$orderStatusId', '$address', '$streetName', '$buildingNumber', '$totalPrice')");

    // Insert Order Products
    self::insertQuery("INSERT INTO `order_products` (`order_token`, `product_id`, `quantity`) VALUES $itemsArray");

    // Unset Cart Session
    unset($_SESSION['cart']);

    // Return to store.php with success message
    $success = "The order has been created successfully. The shipping company will continue the shipping process. <a class='link-primary' href='./orders'>View Order</a>";
    header("location: ./store?success=$success&ordered=1");
  }

  protected static function productSold($productId, $quantity)
  {
    self::insertQuery("UPDATE `product` SET `sold` = `sold` + $quantity, `quantity` = `quantity` - $quantity WHERE `id` = $productId");
  }

  public static function viewAllOrders()
  {
    // Get all orders
    return self::getQueryResults("SELECT `order`.`id`, `order`.`token`, `order`.`user_id`, `user`.`first_name`, `user`.`last_name`, `user`.`phone`, `order`.`address`, `order`.`street_name`, `order`.`building_number`, `product`.`name`,  `order_products`.`quantity`, `product`.`price`, `order`.`total_price`, `order_status`.`status`, `order`.`created_at` from `order` join `user` ON `order`.`user_id` = `user`.`id` join `order_status` ON `order`.`order_status_id` = `order_status`.`id` join `order_products` ON `order`.`token` = `order_products`.`order_token` join `product` ON `order_products`.`product_id` = `product`.`id` ORDER BY `order`.`created_at` DESC");
  }

  public static function viewOrders($userId)
  {
    // Get all orders about this customer
    return self::getQueryResults("SELECT `order`.`id`, `order`.`token`, `order`.`user_id`, `user`.`first_name`, `user`.`last_name`, `user`.`phone`, `order`.`address`, `order`.`street_name`, `order`.`building_number`, `product`.`name`,  `order_products`.`quantity`, `product`.`price`, `order`.`total_price`, `order_status`.`status`, `order`.`created_at` from `order` join `user` ON `order`.`user_id` = `user`.`id` join `order_status` ON `order`.`order_status_id` = `order_status`.`id` join `order_products` ON `order`.`token` = `order_products`.`order_token` join `product` ON `order_products`.`product_id` = `product`.`id` WHERE `order`.`user_id` = $userId ORDER BY `order`.`created_at` DESC");
  }

  public static function delete($orderId)
  {
    self::insertQuery("DELETE FROM `order` WHERE `order`.`id` = $orderId");
    $success = "Order deleted successfully.";
    if (Admin::check()) {
      header("location: ./manageOrders?success=$success");
      exit;
    } else {

      header("location: ./orders?success=$success");
    }
  }
}
