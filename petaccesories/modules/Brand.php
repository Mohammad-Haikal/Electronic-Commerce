<?php

class Brand extends DB
{
  public static function viewAll()
  {
    return self::getQueryResults("SELECT * FROM brand");
  }
  
  public static function getBrand($brandId)
  {
    return self::getQueryResults("SELECT * FROM brand where id = $brandId");
  }

  public static function getBrandName($brandId)
  {
    return self::getQueryResults("SELECT * FROM brand where id = $brandId")[0]['name'];
  }

  public static function getBrandCount($brandId)
  {
    return self::getQueryResults("SELECT count(product.id) as 'count' FROM `product` WHERE brand_id = $brandId")[0]['count'];
  }
}
