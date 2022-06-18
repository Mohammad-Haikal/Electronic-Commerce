<?php

class Feedback extends DB
{
    public static function viewAll()
    {
        return self::getQueryResults("SELECT * FROM `feedback`");
    }

    public static function add($userId, $feedback)
    {
        $conn = self::connect();
        $userId = mysqli_real_escape_string($conn, htmlspecialchars($userId));
        $feedback = mysqli_real_escape_string($conn, htmlspecialchars($feedback));

        if (empty($feedback)) {
            exit;
        }

        self::insertQuery("INSERT INTO `feedback` (`user_id`, `feedback`) VALUES ($userId, '$feedback')");
        header("location: ./store.php");
    }

    public static function delete($feedbackId)
    {
        self::insertQuery("DELETE FROM `feedback` WHERE `feedback`.`id` = $feedbackId");
        $success = "Feedback deleted successfully.";
        header("location: ./manageFeedbacks.php?success=$success");
    }
}
