<?php
namespace App\Model;

use App\Config\Database;
use PDO;

abstract class User {
    protected $username;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($username, $email, $password, $role) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    
    abstract public function signup();

  
    public static function login($email, $password) {
        $conn = Database::getConnection();
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['is_active'] == 0) {
                echo "Votre compte est banni. Contactez l'administrateur pour plus d'informations.";
                exit;
            }
        }

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ];
            return true;
        }
        return false;
    }
    public static function getAllUsers(){
        $conn = Database::getConnection();
        $query = "SELECT * FROM users  ";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
