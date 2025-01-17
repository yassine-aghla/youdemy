<?php
namespace App\Controller;
use App\Model\User;
use App\Model\Student;
use App\Model\Teacher;

class UsersController {
   

    public static function signup($data) {
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
