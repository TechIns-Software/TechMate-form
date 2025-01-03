<?php

namespace TechMateForm;

use Exception;

class Connection
{

    public static function getConnection():\mysqli {
        try {
            // Create connection
            $conn = mysqli_connect(
                $_ENV['DB_HOST'], $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD'], $_ENV['DB_NAME'],
            );
        } catch (Exception $e) {
            die('Connection failed: ' . $e->getMessage());
        }
        return $conn;
    }
}