<?php
namespace App\Model;

use App\Config\Database;

class Teacher extends User {
    public function signup() {
        $conn = Database::getConnection();
        $query = "INSERT INTO users (username, email, password, role) 
                  VALUES (:username, :email, :password, :role)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_BCRYPT),
            ':role' => 'Enseignant'
        ]);
    }
    
}
