<?php

class Message extends DB
{
    public static function viewAll()
    {
        return self::getQueryResults("SELECT * FROM `message`");
    }

    public static function add($name, $phone, $email, $message)
    {
        $conn = self::connect();
        $name = mysqli_real_escape_string($conn, ucwords(htmlspecialchars($name)));
        $phone = mysqli_real_escape_string($conn, htmlspecialchars($phone));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($email));
        $message = mysqli_real_escape_string($conn, htmlspecialchars($message));


        self::insertQuery("INSERT INTO `message` (`name`, `phone`, `email`, `message`) VALUES ('$name', '$phone', '$email', '$message')");
        $success = "Your message has been sent to the admin.";
        header("location: ./contact.php?success=$success");
    }

    public static function delete($messageId)
    {
        self::insertQuery("DELETE FROM `message` WHERE `message`.`id` = $messageId");
        $success = "Message deleted successfully.";
        header("location: ./manageMessages?success=$success");
    }
}
