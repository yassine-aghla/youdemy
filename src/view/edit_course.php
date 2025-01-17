<?php
require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../Controller/CourseController.php';

use App\Config\Database;


use App\Controller\tags;
use App\Controller\CategoriesController;
use App\Model\VideoCourse;
// use App\Controller\CourseController;

$pdo = Database::getConnection();
$tag = new tags();
$tags = $tag->displayTags();
$categorie = new CategoriesController();
$categories = $categorie->displayCategories();
session_start();
$role = $_SESSION['user']['role'];
// Connexion à la base de données
$pdo = Database::getConnection();

// Récupérer l'ID du cour

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = :id");
$stmt->execute([':id' => $id]);
$course = $stmt->fetch();

if (!$course) {
    echo "Cours introuvable.";
    exit;
}

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

#form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin:auto;
             
       
        }

        #form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color:#2a2185;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        .tags-container {
            margin-bottom: 10px;
        }

        .tags-container input[type="checkbox"] {
            margin-right: 8px;
            margin-bottom: 10px;
        }
        .tags-container label{
            color:#2a2185;
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
                        <span class="title"></span>
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
                        <span class="title">Articles</span>
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
                    <a href="tags.php">
                        <span class="icon">
                        <ion-icon name="pricetag-outline"></ion-icon>
                        </span>
                        <span class="title">Tags</span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Auteur</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="sign_up.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
  <!-- =============== Main ================ -->
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

            <!-- le formulaire de modification -->
            <div id="form-container">
            <h2>Modifier un course</h2>
<form action="../controller/CourseController.php" method="POST">
    <input type="hidden" name="course_id" value="<?=  $course['id'] ?>">
    <div>
        <label for="title">Course Title</label>
        <input type="text" id="title" name="title"  value="<?php echo  $course['title']; ?>" placeholder="Enter course title" required>
    </div>
    <div>
        <label for="content">course content </label>
        <input type="text" id="content" name="content"  value="<?php echo  $course['contenu']; ?>" placeholder="Enter course content" required>
    </div>
    <div>
        <label for="description">Course Description</label>
        <textarea id="description" name="description" rows="4"  value="<?php echo  $course['description']; ?>" placeholder="Enter course description" required></textarea>
    </div>
    <div>
        <label for="contenu">Course Content Type</label>
        <select id="contenu" name="contenu" required>
            <option value="">--Please choose content type--</option>
            <option value="video">Video</option>
            <option value="document">Document</option>
        </select>
    </div>
    <div id="video">
        <label for="contenu_video">Video URL</label>
        <input type="url" id="contenu_video" name="contenu_video"  value="<?php echo  $course['video_path']; ?>" placeholder="Enter video URL">
    </div>
    <div id="document" style="display:none;">
        <label for="contenu_document">Course Document</label>
        <textarea id="contenu_document" name="contenu_document"  value="<?php echo  $course['document_path']; ?>" rows="4" placeholder="Enter course document"></textarea>
    </div>
    <div>
        <label for="category_id">Catégorie</label>
        <select id="category_id" name="category_id" required>
            <option value="" disabled selected>Choisir une catégorie</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="tags-container">
    <label style="color:black;">Tags</label>
    <?php 
    $tagStmt = $pdo->prepare("SELECT tag_id FROM course_tags WHERE course_id = ?");
    $tagStmt->execute([$id]);
    $associatedTags = $tagStmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tags as $tag): ?>
    <div>
        <table>
            <td>
                <label for="tag_<?= $tag['id'] ?>"><?= htmlspecialchars($tag['name']) ?></label>
            </td>
            <td>
                <input type="checkbox" id="tag_<?= $tag['id'] ?>" 
                       name="tags[]" 
                       value="<?= $tag['id'] ?>" 
                       <?= in_array($tag['id'], $associatedTags) ? 'checked' : '' ?>>
            </td>
        </table>
    </div>
<?php endforeach; ?>
</div>
   
    <div>
        <label for="featured_image">Featured Image URL</label>
        <input type="url" id="featured_image" name="featured_image" placeholder="Enter image URL" required>
    </div>

    <button type="submit" name="update-course" value="update">Update Course</button>
</form>
    </div>
<script>
       
      

   const contenuSelect = document.getElementById('contenu');
   const videoField = document.getElementById('video');
   const documentField = document.getElementById('document');
   

   contenuSelect.addEventListener('change', () => {
       const selectedValue = contenuSelect.value;
       console.log(selectedValue)
       if (selectedValue ==='video') {
           videoField.style.display = 'block';
           documentField.style.display = 'none';
       } else if (selectedValue ==='document') {
           videoField.style.display = 'none';
           documentField.style.display = 'block';
       } else {
           videoField.style.display = 'none';
           documentField.style.display = 'none';
       }
   });
   </script>
       <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
  <script src="assets/js/chartsJS.js"></script>

  <!-- ====== ionicons ======= -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>