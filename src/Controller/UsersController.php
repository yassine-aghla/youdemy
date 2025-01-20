<?php
namespace App\Controller;
use App\Model\User;
use App\Model\Student;
use App\Model\Teacher;

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
        $role = $data['role'];

        if ($role === 'Etudiant') {
            $user = new Student($data['username'], $data['email'], $data['password'], $role);
        } elseif ($role === 'Enseignant') {
            $user = new Teacher($data['username'], $data['email'], $data['password'], $role);
        } else {
            return "Invalid role!";
        }

        return $user->signup() ? "User created successfully!" : "Error creating user.";
    }

    public static function login($email, $password) {
        return User::login($email, $password);
    }

    public static function getUsers() {
        return User::getAllUsers();
    }
 

}
