<?php
require_once '../../vendor/autoload.php';
require_once __DIR__ . '/../Controller/CourseController.php';
require_once 'home_logic.php'; 
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
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
     .pagination {
    display: flex;
    justify-content: center; 
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

form.search {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    width:35%;
    margin: 20px 0;
    padding: 10px;
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}


form.search input[type="text"] {
    flex: 1;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s;
}

form.search input[type="text"]:focus {
    border-color:#357abd;
    outline: none;
}


form.search button {
    padding: 10px 15px;
    font-size: 1rem;
    color: #fff;
    background-color:#357abd;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

form.search button:hover {
    background-color:#357abd;
    transform: translateY(-2px);
}

form.search button:active {
    transform: translateY(0);
}


@media (max-width: 768px) {
    form.search {
        flex-direction: column;
        gap: 15px;
    }

    form.search input[type="text"], 
    form.search button {
        width: 100%;
    }
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
        <li><a href="home.php">Home</a></li>
        <li><a href="my_courses.php">Mes Courses</a></li>
        <li><a href="../../pages/logout.php">logout</a></li>
       
      </ul>
    </nav>
    <div class="welcome-message">
    <p>Bonjour, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</p>
</div>
  </header>
  <form method="GET" action="home.php" class="search">
    <input type="text" name="search" placeholder="Rechercher un cour par titre" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Rechercher</button>
</form>
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
                <form method="POST" action="../Controller/enroll.php">
                 <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                 <button type="submit">S'inscrire</button>
                  </form>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination">
    <?php
    for ($i = 1; $i <= $totalPagesVideo; $i++) {
        echo '<a href="?page=' . $i . '&search=' . urlencode($search) . '">' . $i . '</a>';
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
                <!--  -->
                <p><strong>Document:</strong> <?= htmlspecialchars(substr($course['document_path'], 0, 3)) ?>...</p>
                <form method="POST" action="../Controller/enroll.php">
                 <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                  <button type="submit">S'inscrire</button>
                  </form>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="pagination">
    <?php
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '&search=' . urlencode($search) .  '">' . $i . '</a>';
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
