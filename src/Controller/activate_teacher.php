<?php
require_once '../../vendor/autoload.php';
use App\Model\User;

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    if (User::activateUser($userId)) {
        header("Location: ../view/dashboard.php?message=teacher_activated");
    } else {
        echo "Error activating user.";
    }
}
?>
