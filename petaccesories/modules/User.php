<?php

class User extends DB
{
  static protected $error;

  protected static function validate($first_name, $last_name, $email, $password, $passwordR)
  {
    // Check first and last name characters
    if (strlen($first_name) > 15) {
      self::$error = "Your first name must be less than 15 characters";
      return false;
    }

    if (strlen($last_name) > 15) {
      self::$error = "Your last name must be less than 15 characters";
      return false;
    }

    // Check email existence
    $users = self::getAllUsers();
    foreach ($users as $user) {
      if ($user['email'] == $email) {
        self::$error = "This email is already exist";
        return false;
      }
    }

    // Check password
    if ($password != $passwordR) {
      self::$error = "The passwords you've entered aren't the same";
      return false;
    }

    // Validate password
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
      self::$error =  "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
      return false;
    }

    return true;
  }

  public static function signup($first_name, $last_name, $email, $phone, $password, $passwordR)
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
      self::insertQuery("INSERT INTO `user` (`first_name`, `last_name`, `email`, `phone`, `password`) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password');");
      $success = "User created successfully";
      header("location: ./login?success=$success");
    } else {
      header("location: ./signup?error=" . self::$error);
      exit;
    }
  }

  public static function login($email, $password)
  {
    $conn = self::connect();
    $email = mysqli_real_escape_string($conn, strtolower(htmlspecialchars($email)));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
    $found = false;

    // Check user existence
    $users = self::getAllUsers();
    foreach ($users as $user) {
      if ($user['email'] == $email && $user['password'] == $password) {
        if ($user['is_admin'] == 1) {
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['admin_id'] = $user['id'];
          header("location: ./dashboard");
        } else {
          $_SESSION['user_id'] = $user['id'];
          header("location: ./store");
        }
        exit;
      }
    }

    if (!$found) {
      $error = "Wrong email or password";
      header("location: ./login?error=$error");
    }
  }

  public static function updatePersonalInfo($first_name, $last_name, $email, $phone)
  {
    $conn = self::connect();
    $first_name = mysqli_real_escape_string($conn, ucwords(htmlspecialchars($first_name)));
    $last_name = mysqli_real_escape_string($conn, ucwords(htmlspecialchars($last_name)));
    $email = mysqli_real_escape_string($conn, strtolower(htmlspecialchars($email)));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars($phone));

    // Check email existence
    $users = self::getAllUsers();
    foreach ($users as $user) {
      if ($user['email'] == $email && $user['id'] != $_SESSION['user_id']) {
        $error = "This email is already exist";
        header("location: ./account?error=$error");
        exit;
      }
    }

    // Update
    self::insertQuery("UPDATE `user` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone` = '$phone' WHERE `user`.`id` = {$_SESSION['user_id']};");
    $success = "Personal info changed successfully";
    header("location: ./account?success=$success");
  }

  public static function updatePassword($oldPassword, $password, $passwordR)
  {
    $conn = self::connect();
    $oldPassword = mysqli_real_escape_string($conn, htmlspecialchars($oldPassword));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($password));
    $passwordR = mysqli_real_escape_string($conn, htmlspecialchars($passwordR));

    // Check old password
    if ($oldPassword != self::getUser()[0]['password']) {
      $error = "The old password is wrong";
      header("location: ./account?error=$error");
      exit;
    }

    // Check password
    if ($password != $passwordR) {
      $error = "The passwords you've entered aren't the same";
      header("location: ./account?error=$error");
      exit;
    }

    // Update
    self::insertQuery("UPDATE `user` SET `password` = '$password' WHERE `user`.`id` = {$_SESSION['user_id']};");
    $success = "Password changed successfully";
    header("location: ./account?success=$success");
  }

  protected static function getAllUsers()
  {
    return self::getQueryResults("SELECT * FROM user");
  }

  public static function viewAllUsers()
  {
    return self::getQueryResults("SELECT * FROM user WHERE is_admin = 0");
  }

  public static function getUserById($id)
  {
    return self::getQueryResults("SELECT * FROM user WHERE id = $id AND is_admin = 0");
  }


  public static function getUserNameById($id)
  {
    $user = self::getQueryResults("SELECT first_name, last_name FROM user WHERE id = $id")[0];
    return $user['first_name'] . " " . $user['last_name'];
  }

  public static function check()
  {
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }

  public static function getUser()
  {
    return self::getQueryResults("SELECT * FROM user where id = {$_SESSION['user_id']}");
  }

  public static function getUserFullName()
  {
    $user = self::getUser()[0];
    return $user['first_name'] . " " . $user['last_name'];
  }

  public static function delete($userId)
  {
    $conn = self::connect();
    $userId = mysqli_real_escape_string($conn, htmlspecialchars($userId));

    self::insertQuery("DELETE FROM `user` WHERE `id` = $userId;");
    $success = "User Deleted successfully";

    header("location: ./manageUsers?success=$success");
  }
}
