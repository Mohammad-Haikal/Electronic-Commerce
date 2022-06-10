<?php

class Visitor extends DB
{

  public static function getVisitorsNumber()
  {
    return self::getQueryResults("SELECT `number` FROM `visitors` WHERE `id` = 1")[0]['number'];
  }

  public static function addVisitor()
  {
    if (!isset($_SESSION['visitor'])) {
        $_SESSION['visitor'] = true;
        return self::insertQuery("UPDATE `visitors` SET `number` = `number` + 1 WHERE `id` = 1");
    }
  }

}
