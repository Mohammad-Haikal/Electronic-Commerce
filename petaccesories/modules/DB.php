<?php

class DB
{
  protected static $servername;
  protected static $username;
  protected static $password;
  protected static $dbname;

  protected static function connect()
  {
    self::$servername = "localhost";
    self::$username = "root";
    self::$password = "";
    self::$dbname = "petaccessories";

    // self::$servername = "sql203.epizy.com";
    // self::$username = "epiz_31973952";
    // self::$password = "gGD7AG42bivGEj5";
    // self::$dbname = "epiz_31973952_petaccessories";
    
    $conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }

  protected static function insertQuery($sql){
    if (self::connect()->query($sql) === TRUE) {
      return true;

    } else {
      echo "Error: " . self::connect()->error;
      return false;
    }
  }

  protected static function getQueryResults($sql){
    $result = mysqli_query(self::connect(), $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
}
