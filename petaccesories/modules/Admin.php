<?php

class Admin extends User
{
  public static function check()
  {
    if (isset($_SESSION['admin_id'])) {
      return true;
    } else {
      return false;
    }
  }

  public static function getAdminFullName()
  {
    $admin = self::getAdmin()[0];
    return $admin['first_name'] . " " . $admin['last_name'];
  }

  public static function getAllAdmins()
  {
    return self::getQueryResults("SELECT * FROM `user` WHERE `is_admin` = 1");
  }

  public static function getAdmin()
  {
    return self::getQueryResults("SELECT * FROM `user` WHERE  `id` = {$_SESSION['admin_id']}");
  }

  public static function addAdmin($first_name, $last_name, $email, $phone, $password, $passwordR)
  {
    $conn = self::connect();
    $first_name = mysqli_real_escape_string($conn, ucwords(htmlspecialchars($first_name)));
    $last_name = mysqli_real_escape_string($conn, ucwords(htmlspecialchars($last_name)));
    $email = mysqli_real_escape_string($conn, strtolower(htmlspecialchars($email)));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars($phone));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
    $passwordR = mysqli_real_escape_string($conn, htmlspecialchars($passwordR));


    if (self::validate($first_name, $last_name, $email, $password, $passwordR)) {
      // Store
      self::insertQuery("INSERT INTO `user` (`is_admin`, `first_name`, `last_name`, `email`, `phone`, `password`) VALUES (1, '$first_name', '$last_name', '$email', '$phone', '$password');");
      $success = "Admin added successfully";
      header("location: ./manageUsers?success=$success");
    } else {
      header("location: ./addAdmin?error=" . self::$error);
      exit;
    }
  }

  public static function delete($adminId)
  {
    $conn = self::connect();
    $adminId = mysqli_real_escape_string($conn, htmlspecialchars($adminId));

    self::insertQuery("DELETE FROM `user` WHERE `id` = $adminId;");
    $success = "Admin Deleted successfully";

    header("location: ./manageUsers?success=$success");
  }
}
