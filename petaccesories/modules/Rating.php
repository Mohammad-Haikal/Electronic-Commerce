<?php

class Rating extends DB
{
    public static function rate($brandId, $rate){
        $rate = intval($rate);
        $info = self::getQueryResults("SELECT rating, num_of_raters FROM brand where id = {$brandId}")[0];
        $oldNum = intval($info['num_of_raters']);
        $oldRate = intval($info['rating']);
        $newNum = $oldNum + 1;
        $result = (($oldRate * $oldNum) + $rate) / $newNum;

        self::insertQuery("UPDATE `brand` SET `rating` = $result, `num_of_raters` = $newNum WHERE `brand`.`id` = $brandId;");
    }

    public static function getBrandRatingInfo($brandId){
        return self::getQueryResults("SELECT rating, num_of_raters FROM brand where id = {$brandId}")[0];
    }

}
