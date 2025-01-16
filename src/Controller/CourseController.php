<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;
use App\Model\VideoCourse;
use App\Model\DocumentCourse;
use App\Model\Course;   


// Récupérer la connexion PDO
$pdo = Database::getConnection();

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $tags = $_POST['tags'];
    $content=$_POST['content'];
    $contenu = $_POST['contenu'];
    var_dump($contenu);
    if ($contenu === 'video') {
      

        $video_path = $_POST['contenu_video'];
        $course = new VideoCourse($title, $description, $category_id, $tags, $video_path,$content);
        header("location:../view/course.php");
    } elseif ($contenu === 'document') {
        $document_path = $_POST['contenu_document'];
        $course = new DocumentCourse($title, $description, $category_id, $tags, $document_path,$content);
         header("location:../view/course.php");
    }

    $course->save($pdo);
}

// Récupérer et afficher les cours
$courses = Course::getCourses($pdo);

