<?php
require_once __DIR__.'/../config/Database.php';

class User {
    private static $table = 'users';

    public static function createUser($data) {
        $conn = Database::getConnection();
        $query = "INSERT INTO " . self::$table . " (username, email, password_hash) 
                  VALUES (:username, :email, :password_hash )";
        $stmt = $conn->prepare($query); 
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password_hash' => $data['password_hash'],
            
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