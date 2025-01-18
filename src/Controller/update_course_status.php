<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../config/Database.php';

    $course_id = intval($_POST['course_id']);
    $status = $_POST['status'];
    $allowed_statuses = ['draft', 'published', 'scheduled'];

    if (!in_array($status, $allowed_statuses)) {
        die("Statut invalide.");
    }

    $stmt = $pdo->prepare("UPDATE courses SET status = ? WHERE id = ?");
    $stmt->execute([$status, $course_id]);

    header("Location: ../view/dashboard.php");
    exit();
}
?>
