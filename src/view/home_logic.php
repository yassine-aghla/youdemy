<?php


use App\Model\VideoCourse;
use App\Model\DocumentCourse;

// session_start();

// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
//     exit();
// }

// Paramètres de pagination et de recherche
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 4;
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Récupérer les cours vidéo
$videoCourses = array_filter(
    VideoCourse::displayCourses($pdo, null, $page, $limit), 
    function ($course) use ($search) {
        $isNotDraft = $course['status'] !== 'draft';
        $matchesSearch = empty($search) || stripos($course['title'], $search) !== false;
        return $isNotDraft && $matchesSearch;
    }
);

// Récupérer les cours document
$documentCourses = array_filter(
    DocumentCourse::displayCourses($pdo, null, $page, $limit), 
    function ($course) use ($search) {
        $isNotDraft = $course['status'] !== 'draft';
        $matchesSearch = empty($search) || stripos($course['title'], $search) !== false;
        return $isNotDraft && $matchesSearch;
    }
);

// Calculer le nombre total de pages
$totalCoursesQuery = "SELECT COUNT(*) FROM courses WHERE video_path IS NULL AND document_path IS NOT NULL";
$stmt = $pdo->query($totalCoursesQuery);
$totalCourses = $stmt->fetchColumn();
$totalPages = ceil($totalCourses / $limit);

$totalCoursesVideoQuery = "SELECT COUNT(*) FROM courses WHERE video_path IS NOT NULL AND document_path IS NULL";
$stmt = $pdo->query($totalCoursesVideoQuery);
$totalCoursesVideo = $stmt->fetchColumn();
$totalPagesVideo = ceil($totalCoursesVideo / $limit);
?>
