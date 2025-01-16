<?php
require_once __DIR__.'/../model/user.php';

class UsersController {
    public static function signup($data) {
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            return "All fields are required!";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format!";
        }
        if (strlen($data['username']) < 3 || strlen($data['username']) > 50) {
            return "Username must be between 3 and 50 characters!";
        }
        
        if (strlen($data['password']) < 8 || !preg_match('/[A-Z]/', $data['password']) ||
            !preg_match('/[0-9]/', $data['password']) || !preg_match('/[\W]/', $data['password'])) {
            return "Password must be at least 8 characters long and include an uppercase letter, a number, and a special character!";
        }
         $existingUser = User::findUserByEmail($data['email']);
         if ($existingUser) {
             return "Email already exists!";
        }

         $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
         unset($data['password']);

        return User::createUser($data) ? "User created successfully!" : "Error creating user.";
    }

    public static function login($email, $password) {
        $user = User::findUserByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            session_start();
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                
            ];
            
            return true;
        }
        return false;
    }
}