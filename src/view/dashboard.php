<?php
// session_start();
// if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !=='Admin') {
//     header('Location:../../public/index.php');
//     exit();
// }
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
//     exit();
// }
require_once '../../vendor/autoload.php';
use App\Model\Course; 
use App\Model\Admin;  
use  App\Model\User;
use App\Config\Database;
$pdo = Database::getConnection();
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !=='Admin') {
    header('Location: index.php');
    exit();
}
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role =$_SESSION['user']['role'];
require_once __DIR__.'/../controller/tags.php';
require_once __DIR__.'/../controller/categoriesController.php';
$totalCourses = Course::countCourses($pdo);
$stats = Admin::getAdminStats();
$categoriesStats = Admin::getCoursesByCategory();
$userCount=User::getUsersCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .admin-stats-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.admin-stats-container h2 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
    color: #333;
}

.admin-stats-container h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #2a2185;
}

.admin-stats-container p, .admin-stats-container li {
    font-size: 16px;
    color: #666;
    margin-bottom: 10px;
}

.admin-stats-container ol {
    padding-left: 20px;
}


    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
            
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title"><?php echo $_SESSION['user']['username'];?></span>
                    </a>
                </li>
                <?php if ($role==='Admin'): ?>
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if ($role ==='Enseignant'): ?>
                <li>
                    <a href="course.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">courses</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($role==='Admin'): ?>
                <li>
                    <a href="categories.php">
                        <span class="icon">
                            <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="title">Categorie</span>
                    </a>
                </li>
                <li>
                    <a href="manage_course.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">manage courses</span>
                    </a>
                </li>
                <li>
                    <a href="manage_teacher.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">manage teacher</span>
                    </a>
                </li>
                <li>
                    <a href="tags.php">
                        <span class="icon">
                            <ion-icon name="pricetag-outline"></ion-icon>
                        </span>
                        <span class="title">Tags</span>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">User</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                <a href="../../pages/logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="../../assets/me.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalCourses ?></div>
                        <div class="cardName">Cours</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="document-text-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $userCount ?></div>
                        <div class="cardName">Users</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $tagsCount ?></div>
                        <div class="cardName">Tags</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="pricetag-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $countcategorie ?></div>
                        <div class="cardName">Categories</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="grid-outline"></ion-icon>

                    </div>
                </div>
            </div>

            <!-- ================ Add Charts JS ================= -->
            <div class="admin-stats-container">
    <h2>Statistiques Globales</h2>
    
    <div class="top-course">
        <h3>Cours avec le plus d'étudiants :</h3>
        <p><strong><?= htmlspecialchars($stats['top_course']['title']) ?></strong> 
        avec <?= $stats['top_course']['total_students'] ?> étudiants inscrits.</p>
    </div>
    
    <div class="top-teachers">
        <h3>Top 3 Enseignants :</h3>
        <ol>
            <?php foreach ($stats['top_teachers'] as $teacher): ?>
                <li>
                    <strong><?= htmlspecialchars($teacher['teacher_name']) ?></strong> 
                    - <?= $teacher['total_students'] ?> étudiants inscrits.
                </li>
            <?php endforeach; ?>
        </ol>
        </div>
            <h3>Répartition des cours par catégorie :</h3>
                 <ul>
                  <?php foreach ($categoriesStats as $category): ?>
            <li>
            <?= htmlspecialchars($category['category_name']) ?> : <?= $category['total_courses'] ?> cours
             </li>
                 <?php endforeach; ?>
</ul>
</div>






            <script src="dashboard.js"></script>


            <!-- ======= Charts JS ====== -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
            <script src="assets/js/chartsJS.js"></script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>