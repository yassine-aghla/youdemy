<?php
require_once '../../vendor/autoload.php';
require_once __DIR__ . '/../Controller/CourseController.php';
use App\Model\VideoCourse;
use App\Model\DocumentCourse;
// session_start();
$role = $_SESSION['user']['role'];
$courses = array_merge(
    VideoCourse::displayCourses($pdo),
    DocumentCourse::displayCourses($pdo)
);
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
        h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
    text-transform: uppercase;
}


table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    overflow: hidden;
}

thead th {
    background-color:#2a2185;
    color: #fff;
    text-align: left;
    padding: 10px;
    font-weight: bold;
    text-transform: uppercase;
}


tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

td, th {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}
td:last-child {
    display: flex;
    flex-direction:column;
    justify-content: space-between; 
    gap: 10px; 
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

            <!-- ======================= manage course ================== -->
            <h1>Liste des Cours</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Statut</th>
            <th>Enseignant</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= htmlspecialchars($course['id']) ?></td>
                    <td><?= htmlspecialchars($course['title']) ?></td>
                    <td><?= htmlspecialchars($course['contenu']) ?></td>
                    <td>
                        <form method="POST" action="update_course_status.php">
                            <input type="hidden" name="course_id" value="<?= htmlspecialchars($course['id']) ?>">
                            <select name="status">
                                <option value="draft" <?= $course['status'] === 'draft' ? 'selected' : '' ?>>Brouillon</option>
                                <option value="published" <?= $course['status'] === 'published' ? 'selected' : '' ?>>Publié</option>
                                <option value="scheduled" <?= $course['status'] === 'scheduled' ? 'selected' : '' ?>>Programmé</option>
                            </select>
                            <button type="submit">Modifier le statut</button>
                        </form>
                    </td>
                    <td><?= htmlspecialchars($course['teacher_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Aucun cours trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


          






            <script src="dashboard.js"></script>


            <!-- ======= Charts JS ====== -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
            <script src="assets/js/chartsJS.js"></script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>