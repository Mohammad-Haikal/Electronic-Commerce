<?php

class Category extends DB
{
  public static function viewAll()
  {
    return self::getQueryResults("SELECT * FROM category");
  }

  public static function getCategory($catId)
  {
    return self::getQueryResults("SELECT * FROM category where id = $catId")[0]['category'];
  }

  public static function getProductsCount($catId)
  {
    return self::getQueryResults("SELECT count(product.id) as 'count' FROM `product` WHERE category_id = $catId")[0]['count'];
  }

}