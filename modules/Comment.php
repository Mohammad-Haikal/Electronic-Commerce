<?php

class Comment extends DB
{

    public static function getAllComments($productId)
    {
        return self::getQueryResults("SELECT comment.id, comment.user_id, user.first_name as 'user_first_name', user.last_name as 'user_last_name', comment.comment, comment.created_at FROM `comment` JOIN `user` on `comment`.`user_id` = `user`.`id` WHERE comment.product_id = $productId ORDER BY comment.created_at DESC");
    }

    public static function add($userId, $productId, $comment)
    {
        $conn = self::connect();
        $userId = mysqli_real_escape_string($conn, htmlspecialchars($userId));
        $productId = mysqli_real_escape_string($conn, htmlspecialchars($productId));
        $comment = mysqli_real_escape_string($conn, htmlspecialchars($comment));

        if (empty($comment)) {
            header("location: ./store");
            exit;
        }

        self::insertQuery("INSERT INTO `comment` (`user_id`, `product_id`, `comment`) VALUES ($userId, $productId, '$comment')");
        header("location: ./store");
    }

    public static function delete($commentId)
    {
        $conn = self::connect();
        $commentId = mysqli_real_escape_string($conn, htmlspecialchars($commentId));

        self::insertQuery("DELETE FROM `comment` WHERE `id` = $commentId");
        header("location: ./store");
    }
}
