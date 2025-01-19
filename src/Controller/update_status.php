<?php
namespace App\Config;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = Database::getConnection();
    $cour_id = intval($_POST['course_id']);
    $status = $_POST['status'];
    $allowed_statuses = ['draft', 'published', 'scheduled'];
    if (!in_array($status, $allowed_statuses)) {
        die("Statut invalide");
    }
    $stmt = $conn->prepare("UPDATE courses SET status = ? WHERE id = ?");
    $stmt->execute([$status,$cour_id]);
    header("Location: ../view/manage_course.php");
    exit();
}
?>