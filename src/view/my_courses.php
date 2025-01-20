<?php
require_once '../../vendor/autoload.php'; 
use App\Model\Student;

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Etudiant') {
    header("Location: login.php");
    exit;
}

$studentId = $_SESSION['user']['id'];
$enrolledCourses = Student::getEnrolledCourses($studentId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform</title>
  <link rel="stylesheet" href="../../assets/css/index.css">
  <style>




h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

.courses-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}


.course-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 300px;
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}


.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}


.course-card h3 {
    font-size: 1.5em;
    margin: 0 0 10px;
    color: #007bff;
}


.course-card p {
    font-size: 0.95em;
    color: #555;
    margin: 10px 0;
}


.course-card a {
    display: inline-block;
    text-decoration: none;
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    transition: background-color 0.3s;
}

.course-card a:hover {
    background-color: #0056b3;
}
.details a{
  background-color:rgb(11, 30, 50);
}
.details_form{
  display:flex;
  gap:10px;
}

</style>
</head>
<body>
<header>
    <div class="logo">
      <h1>Youdemy</h1>
    </div>
    <nav class="navbar">
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="my_courses.php">Mes Courses</a></li>
        <li><a href="../../pages/logout.php">logout</a></li>
       
      </ul>
    </nav>
    <div class="welcome-message">
    <p>Bonjour, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</p>
</div>
  </header>
  <div>
<h2>Mes Cours</h2>
<div class="courses-container">
    <?php foreach ($enrolledCourses as $course): ?>
    
        <div class="course-card">
         
            <h3><?= htmlspecialchars($course['title']) ?></h3>
            <p><strong>Description:</strong> <?= htmlspecialchars($course['description']) ?></p>
            <p><strong>Contenu:</strong> <?= htmlspecialchars($course['contenu']) ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($course['category_name']) ?></p>
            <?php if ($course['video_path']): ?>
                <iframe src="<?= htmlspecialchars($course['video_path']) ?>" width="300" height="200" frameborder="0" allowfullscreen></iframe>
            <?php endif; ?>
            <?php if ($course['document_path']): ?>
            <p><strong>Document:</strong> <?= htmlspecialchars(substr($course['document_path'], 0, 3)) ?>...</p>
            <?php endif; ?>
            <div class="details_form">
            <div class="forms">
            <form method="POST" action="../Controller/enroll.php">
          <input type="hidden" name="course_id" value="<?= htmlspecialchars($course['id']) ?>">
         <input type="hidden" name="action" value="unenroll">
          <button type="submit" class="unenroll-button">Se désinscrire</button>
          </form>
          </div>
          <div class="details">
          <a href="course_details.php?id=<?= htmlspecialchars($course['id']) ?>" class="course-link">view details</a>
          </div>
          </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
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
        <li><a href="../pages/logout.php">Login</a></li>
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

