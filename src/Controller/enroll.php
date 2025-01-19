<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Model\User;

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Etudiant') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_SESSION['user']['id'];
    $courseId = $_POST['course_id'];

    if (User::enrollToCourse($studentId, $courseId)) {
        header("location:../view/home.php");
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
