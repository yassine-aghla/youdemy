<?php
require_once '../vendor/autoload.php';
require_once __DIR__ . '/../src/Controller/CourseController.php';
// use App\Config\Database;
use App\Model\VideoCourse;
use App\Model\DocumentCourse;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 4;
$videoCourses = VideoCourse::displayCourses($pdo,null,$page, $limit);
$documentCourses = DocumentCourse::displayCourses($pdo,null,$page, $limit);
$totalCoursesQuery = "SELECT COUNT(*) FROM courses WHERE video_path IS NULL AND document_path IS NOT NULL";
$stmt = $pdo->query($totalCoursesQuery);
$totalCourses = $stmt->fetchColumn();
$totalPages = ceil($totalCourses / $limit);
$totalCoursesVideoQuery = "SELECT COUNT(*) FROM courses WHERE video_path IS NOT NULL AND document_path IS NULL";
$stmt = $pdo->query($totalCoursesVideoQuery);
$totalCoursesVideo = $stmt->fetchColumn();
$totalPagesVideo = ceil($totalCoursesVideo  / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform</title>
  <link rel="stylesheet" href="../assets/css/index.css">
  <style>
     .pagination {
    display: flex;
    justify-content: center; /* Centrer les liens */
    align-items: center;
    margin-top: 20px;
    
    
}

.pagination a {
    margin: 0 5px; 
    padding: 10px 15px; 
    text-decoration: none;
    color: #fff;
    background-color: #007bff; 
    border-radius: 5px; 
    font-weight: bold; 
    transition: background-color 0.3s ease; 
}

.pagination a:hover {
    background-color: #0056b3; 
}

.pagination a:active {
    background-color: #004085; 
}

.pagination a.disabled {
    background-color: #ddd; 
    color: #999;
    cursor: not-allowed; 
}

.pagination .current-page {
    
    color: #fff; 
    cursor: default; 
}

.pagination a:first-child {
    margin-left: 0; 
}

.pagination a:last-child {
    margin-right: 0; 
}

    </style>
</head>
<body>
  <!-- Header Section -->
  <header>
    <div class="logo">
      <h1>Youdemy</h1>
    </div>
    <nav class="navbar">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#courses">Courses</a></li>
        <li><a href="../pages/sign_up.php">Signup</a></li>
        <li><a href="../pages/login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h2>Welcome to Youdemy!</h2>
    <p>Explore our platform and unlock your learning potential.</p>
  </main>
  <section class="courses-section">
    <h2>Video Courses</h2>
    <div class="courses-container">
        <?php foreach ($videoCourses as $course): ?>
            <div class="course-card">
                <iframe src="<?= htmlspecialchars($course['video_path']) ?>" width="300" height="200" frameborder="0" allowfullscreen></iframe>
                <h3><?= htmlspecialchars($course['title']) ?></h3>
                <p><?= htmlspecialchars($course['contenu']) ?></p>
                <p><strong>Teacher:</strong> <?= htmlspecialchars($course['teacher_name']) ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($course['category_name']) ?></p>
                <p><strong>Tags:</strong> <?= htmlspecialchars($course['tags']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination">
    <?php
    for ($i = 1; $i <= $totalPagesVideo; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a>';
    }
    ?>
</div>

    <h2>Document Courses</h2>
    <div class="courses-container">
        <?php foreach ($documentCourses as $course): ?>
            <div class="course-card">
                <img src="https://via.placeholder.com/300x200" alt="Document Icon">
                <h3><?= htmlspecialchars($course['title']) ?></h3>
                <p><?= htmlspecialchars($course['contenu']) ?></p>
                <p><strong>Teacher:</strong> <?= htmlspecialchars($course['teacher_name']) ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($course['category_name']) ?></p>
                <p><strong>Tags:</strong> <?= htmlspecialchars($course['tags']) ?></p>
                <a href="<?= htmlspecialchars($course['document_path']) ?>" target="_blank">View Document</a>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="pagination">
    <?php
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a>';
    }
    ?>
</div>
          
</section>


<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h3>About Youdemy</h3>
      <p>Youdemy is a platform designed to help you achieve your learning goals with a variety of courses in different fields.</p>
    </div>
    <div class="footer-column">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#courses">Courses</a></li>
        <li><a href="../pages/sign_up.php">Signup</a></li>
        <li><a href="../pages/login.php">Login</a></li>
        <li><a href="#faq">FAQ</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>Contact Us</h3>
      <ul>
        <li>Email: support@youdemy.com</li>
        <li>Phone: +212 600 000 000</li>
        <li>Address: 123 Education Lane, Casablanca</li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>Follow Us</h3>
      <div class="social-links">
        <a href="https://facebook.com" target="_blank">Facebook</a>
        <a href="https://twitter.com" target="_blank">Twitter</a>
        <a href="https://instagram.com" target="_blank">Instagram</a>
        <a href="https://linkedin.com" target="_blank">LinkedIn</a>
      </div>
    </div>

</body>
</html>
