<?php

namespace App\Model;

use App\Config\Database;
use PDO;
class User {
    private static $table = 'users';

    public static function createUser($data) {
        $conn = Database::getConnection();
        $query = "INSERT INTO " . self::$table . " (username, email, password,role) 
                  VALUES (:username, :email, :password, :role)";
        $stmt = $conn->prepare($query); 
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role' => $data['role'],

            
        ]);
    }
      public static function findUserByEmail($email) {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . " WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}