<?php

class Product extends DB
{
  // protected method
  protected static function imageValidate($image)
  {
    var_dump($image);
    $target_dir = "./img/products/";
    $target_file = $target_dir . time() . basename($image["name"][0]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
      $error = "Sorry, your image was not uploaded, This image already exists, try to change its name before uploading.";
      header("location: ./dashboard?error=$error");
      exit;
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
      $error = "Sorry, your image was not uploaded, only JPG, JPEG, or PNG files are allowed.";
      header("location: ./dashboard?error=$error");
      exit;
      $uploadOk = 0;
    }

    // if everything is ok, try to upload file
    if ($uploadOk == 1) {
      if (move_uploaded_file($image["tmp_name"][0], $target_file)) {
        return $target_file;
      } else {
        $error = "Sorry, there was an error uploading your file.";
        header("location: ./dashboard?error=$error");
        exit;
      }
    }
  }

  // Add product
  public static function add($brandId, $categoryId, $name, $image, $description, $price, $quantity)
  {
    // Call Image validation method and return its path if there is no errors 
    $image_target_path = self::imageValidate($image);

    $conn = self::connect();
    $brandId = mysqli_real_escape_string($conn, htmlspecialchars($brandId));
    $categoryId = mysqli_real_escape_string($conn, htmlspecialchars($categoryId));
    $name = mysqli_real_escape_string($conn, ucwords(htmlspecialchars($name)));
    $description = mysqli_real_escape_string($conn, htmlspecialchars($description));
    $price = mysqli_real_escape_string($conn, htmlspecialchars($price));
    $quantity = mysqli_real_escape_string($conn, htmlspecialchars($quantity));

    echo $image_target_path;

    // Store
    self::insertQuery("INSERT INTO `product` (`brand_id`, `category_id`, `name`, `image`, `description`, `price`, `quantity`) VALUES ($brandId, $categoryId, '$name', '$image_target_path', '$description', '$price', '$quantity')");
    $success = "Product added successfully";
    header("location: ./manageProducts?success=$success");
  }

  public static function getProduct($productId)
  {
    return self::getQueryResults("SELECT * FROM product where id= $productId")[0];
  }

  public static function getAllProducts()
  {
    return self::getQueryResults("SELECT * FROM product ORDER BY created_at DESC");
  }

  public static function viewAll()
  {
    return self::getQueryResults("SELECT * FROM product where active = 1 and quantity > 0 ORDER BY created_at DESC");
  }

  public static function viewSupplierProducts($brandId)
  {
    return self::getQueryResults("SELECT * FROM product where `brand_id` = $brandId AND active = 1 ORDER BY created_at DESC");
  }

  public static function getAllImages()
  {
    return self::getQueryResults("SELECT `image` FROM product");
  }

  // Search and Filter
  public static function search($value)
  {
    $conn = self::connect();
    $value = mysqli_real_escape_string($conn, htmlspecialchars($value));
    return self::getQueryResults("SELECT * FROM product WHERE (`active` = 1 AND `quantity` > 0) AND (`name` LIKE '%$value%' OR `description` LIKE '%$value%') ORDER BY created_at DESC");
  }

  public static function filter($min, $max, $brads, $cats)
  {
    $conn = self::connect();
    $min = mysqli_real_escape_string($conn, htmlspecialchars($min));
    $max = mysqli_real_escape_string($conn, htmlspecialchars($max));
    $brads = mysqli_real_escape_string($conn, htmlspecialchars($brads));
    $cats = mysqli_real_escape_string($conn, htmlspecialchars($cats));

    if (empty($cats) && empty($brads)) {
      // echo "SELECT * FROM product WHERE price BETWEEN $min AND $max";
      return self::getQueryResults("SELECT * FROM product WHERE (`active` = 1 AND `quantity` > 0) AND (price BETWEEN $min AND $max) ORDER BY created_at DESC");
    } elseif (empty($cats)) {
      // echo "SELECT * FROM product WHERE price BETWEEN $min AND $max AND brand_id IN($brads)";
      return self::getQueryResults("SELECT * FROM product WHERE (`active` = 1 AND `quantity` > 0) AND (price BETWEEN $min AND $max AND brand_id IN($brads)) ORDER BY created_at DESC");
    } elseif (empty($brads)) {
      // echo "SELECT * FROM product WHERE price BETWEEN $min AND $max AND category_id IN($cats)";
      return self::getQueryResults("SELECT * FROM product WHERE (`active` = 1 AND `quantity` > 0) AND (price BETWEEN $min AND $max AND category_id IN($cats)) ORDER BY created_at DESC");
    } else {
      // echo "SELECT * FROM product WHERE price BETWEEN $min AND $max AND category_id IN($cats) AND brand_id IN($brads)";
      return self::getQueryResults("SELECT * FROM product WHERE (`active` = 1 AND `quantity` > 0) AND (price BETWEEN $min AND $max AND category_id IN($cats)) AND brand_id IN($brads) ORDER BY created_at DESC");
    }
  }

  // Update info
  public static function updateImg($productId, $oldImage, $image)
  {
    // Check if file already exists
    if (file_exists($oldImage)) {
      unlink($oldImage);
    }

    // Call Image validation method and return its path if there is no errors 
    $image_target_path = self::imageValidate($image);

    $conn = self::connect();
    $productId = mysqli_real_escape_string($conn, htmlspecialchars($productId));

    self::insertQuery("UPDATE `product` SET `image` = '$image_target_path' WHERE `product`.`id` = $productId;");
    $success = "Product Image updated successfully";
    if ($_SESSION['admin_id']) {
      header("location: ./manageProducts?success=$success");
      exit;
    }
    header("location: ./dashboard?success=$success");
  }

  public static function updateInfo($productId, $name, $brandId, $categoryId, $description, $price, $quantity)
  {
    $conn = self::connect();
    $productId = mysqli_real_escape_string($conn, htmlspecialchars($productId));
    $name = mysqli_real_escape_string($conn, htmlspecialchars($name));
    $brandId = mysqli_real_escape_string($conn, htmlspecialchars($brandId));
    $categoryId = mysqli_real_escape_string($conn, htmlspecialchars($categoryId));
    $description = mysqli_real_escape_string($conn, htmlspecialchars($description));
    $price = mysqli_real_escape_string($conn, htmlspecialchars($price));
    $quantity = mysqli_real_escape_string($conn, htmlspecialchars($quantity));

    self::insertQuery("UPDATE `product` SET `name` = '$name', `brand_id` = '$brandId', `category_id` = '$categoryId', `description` = '$description', `price` = '$price', `quantity` = '$quantity' WHERE `product`.`id` = $productId;");
    $success = "Product info updated successfully";
    if ($_SESSION['admin_id']) {
      header("location: ./manageProducts?success=$success");
      exit;
    }
    header("location: ./dashboard?success=$success");
  }

  // Delete
  public static function delete($productId, $imagePath)
  {
    $conn = self::connect();
    $productId = mysqli_real_escape_string($conn, htmlspecialchars($productId));
    $imagePath = htmlspecialchars($imagePath);

    // Check if file already exists
    if (file_exists($imagePath)) {
      unlink($imagePath);
    }

    self::insertQuery("DELETE FROM `product` WHERE `id` = $productId;");
    $success = "Product Deleted successfully";
    header("location: ./manageProducts?success=$success");
  }

  // Activate
  public static function activate($productId)
  {
    $conn = self::connect();
    $productId = mysqli_real_escape_string($conn, htmlspecialchars($productId));


    self::insertQuery("UPDATE `product` SET `active` = '1' WHERE `product`.`id` = $productId;");
    $success = "Product activated";
    header("location: ./manageProducts?success=$success");
  }

  // Deactivate
  public static function deactivate($productId)
  {
    $conn = self::connect();
    $productId = mysqli_real_escape_string($conn, htmlspecialchars($productId));


    self::insertQuery("UPDATE `product` SET `active` = '0' WHERE `product`.`id` = $productId;");
    $success = "Product deactivated";
    header("location: ./manageProducts?success=$success");
  }
}
