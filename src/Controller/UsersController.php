<?php
namespace App\Controller;

use App\Model\User;

class UsersController {
    public static function signup($data) {
        var_dump($data);
        if (!in_array($data['role'], ['Etudiant', 'Admin', 'Enseignant'])) {
            return "Invalid role!";
        }

        $existingUser = User::findUserByEmail($data['email']);
        if ($existingUser) {
            return "Email already exists!";
        }

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        // unset($data['password']);

        return User::createUser($data) ? "User created successfully!" : "Error creating user.";
    }


    // public static function login($email, $password) {
    //     $user = User::findUserByEmail($email);
    //     if ($user && password_verify($password, $user['password_hash'])) {
    //         session_start();
    //         $_SESSION['user'] = [
    //             'id' => $user['id'],
    //             'username' => $user['username'],
                
    //         ];
            
    //         return true;
    //     }
    //     return false;
    // }
    public static function getAllUsers() {
        return User::getAllUsers();
    }
}