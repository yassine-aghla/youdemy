<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Model\Student;

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Etudiant') {
    header("Location: login.php");
    exit;
}
$studentId = $_SESSION['user']['id'];
$courseId = $_POST['course_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (Student::enrollToCourse($studentId, $courseId)) {
        header("location:../view/home.php");
    } else {
        echo "Erreur lors de l'inscription.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action']) {
      if (Student::unenrollFromCourse($studentId, $courseId)) {
        header("location:../view/my_courses.php?success=unenrolled");
    } else {
        echo "Erreur lors de la désinscription.";
    }

}