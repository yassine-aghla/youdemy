<?php
require_once '../../vendor/autoload.php';
use App\Model\User;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    if (isset($_POST['action']) && $_POST['action'] === 'ban') {
        $result = User::banUser($userId); 
        header("Location:users.php");
        exit();
    }
}