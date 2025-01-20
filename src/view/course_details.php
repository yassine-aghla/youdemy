<?php
require_once '../../vendor/autoload.php'; 
use App\Model\Course;
if (isset($_GET['id'])) {
   
    $course_id = $_GET['id'];
    $courseDetails = Course::getCourseDetails($course_id);
  
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform</title>
  <link rel="stylesheet" href="../../assets/css/index.css">
  <style>
    /* Style de la page des cours */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin: 20px 0;
    font-size: 2rem;
    color: #333;
}

.courses-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.course-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 280px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.course-card h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #333;
}

.course-card p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 10px;
}

.course-card iframe {
    width: 100%;
    height: 200px;
    border: none;
    margin-top: 10px;
}



a.course-link {
    text-decoration: none;
}


.course-detail {
    background-color: #fff;
    padding: 40px;
    margin: 20px auto;
    max-width: 800px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.course-detail h3 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
}

.course-detail p {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 15px;
}

.course-detail iframe {
    width: 100%;
    height: 400px;
    border: none;
    margin-top: 20px;
}

.course-detail a {
    color: #1e88e5;
    text-decoration: none;
}

.course-detail a:hover {
    text-decoration: underline;
}

.course-detail .course-actions {
    margin-top: 30px;
    text-align: center;
}
.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 10px 0;
    padding: 0;
    list-style: none;
}

.tag {
    background-color: #f3f4f6; 
    color: #333; 
    font-size: 14px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 20px;
    border: 1px solid #ddd;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.tag:hover {
    background-color: #4f46e5; 
    color: #fff; 
    cursor: pointer;
}


@media (max-width: 768px) {
    .courses-container {
        flex-direction: column;
        align-items: center;
    }

    .course-card {
        width: 90%;
    }

    .course-detail {
        padding: 20px;
    }
}

</style>
<h2>Détails du Cour</h2>
<div class="course-detail">
    
    <h3><?= htmlspecialchars($courseDetails['title']) ?></h3>
    <p><strong>Description:</strong> <?= htmlspecialchars($courseDetails['description']) ?></p>
    <p><strong>Contenu:</strong> <?= htmlspecialchars($courseDetails['contenu']) ?></p>
    <p><strong>Teacher:</strong> <?= htmlspecialchars($courseDetails['teacher_name']) ?></p>
    <p><strong>Email Teacher:</strong> <?= htmlspecialchars($courseDetails['teacher_email']) ?></p>
    <p><strong>Category:</strong> <?= htmlspecialchars($courseDetails['category_name']) ?></p>
    <?php if (!empty($courseDetails['tags'])): ?>
        <p><strong>Tags:</strong></p>
        <ul class="tags-container">
            <?php foreach (explode(',', $courseDetails['tags']) as $tag): ?>
                <li class="tag"><?= htmlspecialchars(trim($tag)) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    
    <?php if ($courseDetails['video_path']): ?>
        <iframe src="<?= htmlspecialchars($courseDetails['video_path']) ?>" width="300" height="200" frameborder="0" allowfullscreen></iframe>
    <?php endif; ?>

    <?php if ($courseDetails['document_path']): ?>
        <p><strong>Document:</strong> <?= htmlspecialchars($courseDetails['document_path']) ?></p>
    <?php endif; ?>
</div>


</body>
</html>