<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;
use App\Model\VideoCourse;
use App\Model\DocumentCourse;
use App\Model\Course;   
// Récupérer la connexion PDO
$pdo = Database::getConnection();
// create the course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $tags = $_POST['tags'];
    $content=$_POST['content'];
    $contenu = $_POST['contenu'];
    // var_dump($contenu);
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
// update cours
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-course'])) {
    var_dump($_POST);
    $id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id =$_POST['category_id']; // Ensure category_id is an integer
    // $tags = $_POST['tags'];
    $content = $_POST['content'];
    // $contenu = $_POST['contenu'];


    // SQL query to update course
    $query = "UPDATE courses SET title = ?, description = ?, contenu = ?, category_id = ? WHERE id = ?";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);

    // Check if inputs are valid and execute the statement


    $stmt->execute([$title, $description, $content, $category_id, $id]);

    // Redirect after update
    header('Location: ../view/course.php');
    exit;
}


