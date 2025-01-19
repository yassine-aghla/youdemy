<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;
use App\Model\VideoCourse;
use App\Model\DocumentCourse;
use App\Model\Course;   

session_start();
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
    $teacher_id=$_SESSION['user']['id'];

    
    // var_dump($contenu);
    if ($contenu === 'video') {
      
        $video_path = $_POST['contenu_video'];
        $course = new VideoCourse($title, $description, $category_id, $teacher_id,$tags, $video_path,$content);
        header("location:../view/course.php");
    } elseif ($contenu === 'document') {
        $document_path = $_POST['contenu_document'];
        $course = new DocumentCourse($title, $description, $category_id, $teacher_id, $tags, $document_path,$content);
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
    $category_id =$_POST['category_id']; 
     $tags = $_POST['tags'];
    $content = $_POST['content'];
     $contenu = $_POST['contenu'];
     if ($contenu === 'video') {
      $video_path = $_POST['contenu_video'];
$query = "UPDATE courses SET title = ?, description = ?, contenu = ?, video_path = ?, document_path = NULL, category_id = ? WHERE id = ?";
 $stmt = $pdo->prepare($query);
 $stmt->execute([$title, $description, $content, $video_path ,$category_id,$id]);
     }
     elseif ($contenu === 'document') {
        $document_path = $_POST['contenu_document'];
  $query = "UPDATE courses SET title = ?, description = ?, contenu = ?, video_path = NULL ,document_path = ?, category_id = ? WHERE id = ?";
   $stmt = $pdo->prepare($query);
   $stmt->execute([$title, $description, $content, $document_path,$category_id, $id]);
       }
 $deleteTagsQuery = "DELETE FROM course_tags WHERE course_id = ?";
    $stmt = $pdo->prepare($deleteTagsQuery);
    $stmt->execute([$id]);

    // Ajouter les nouveaux tags associés au cours
    $insertTagsQuery = "INSERT INTO course_tags (course_id, tag_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($insertTagsQuery);

    foreach ($tags as $tagId) {
        $stmt->execute([$id, $tagId]);
    }

    header('Location: ../view/course.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $id = $_GET['id'];

        // Suppression de la base de données
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = :id");
        $stmt->execute([':id' => $id]);

        // Rediriger après suppression
        header('Location: ../view/course.php');
        exit;
    }
}

