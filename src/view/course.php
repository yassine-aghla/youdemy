<?php
require_once '../../vendor/autoload.php';
require_once __DIR__ . '/../Controller/CourseController.php';
use App\Controller\tags;
use App\Controller\CategoriesController;
use App\Config\Database;
use App\Model\VideoCourse;
use App\Model\DocumentCourse;
// session_start();

if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    exit();
}
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['user']['role'];

// use App\Controller\CourseController;

$pdo = Database::getConnection();
$tag=new tags();
$tags=$tag->displayTags();
$categorie=new CategoriesController();
$categories=$categorie->displayCategories();
$teacherId = $_SESSION['user']['id']; 

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
            display: none; 
       
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
        #add-article-btn{
            width: 160px;
            }
            
a {
    font-weight: bold;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}


a[href^="edit_article.php"] {
    margin-top: 0px;
    color: #27ae60; 
    border: 1px solid #27ae60;
}

a[href^="edit_article.php"]:hover {
    background-color: #27ae60;
    color: #fff;
}


a[href^="delete_article.php"] {
    margin-bottom: 0px;
    color: #e74c3c; 
    border: 1px solid #e74c3c;
}

a[href^="delete_article.php"]:hover {
    background-color: #e74c3c;
    color: #fff;
}



    </style>
    </head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
              
                    <a href="">
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
                        <span class="title">Auteur</span>
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
  <!-- =============== formualire ================ -->

  <button id="add-article-btn">Add cours</button>
  <div id="form-container">
  <h2>Ajouter un course</h2>
  <form action="../controller/CourseController.php" method="POST">

    <div>
        <label for="title">Course Title</label>
        <input type="text" id="title" name="title" placeholder="Enter course title" required>
    </div>
    <div>
        <label for="content">course content </label>
        <input type="text" id="content" name="content" placeholder="Enter course content" required>
    </div>
    <div>
        <label for="description">Course Description</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter course description" required></textarea>
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
        <input type="url" id="contenu_video" name="contenu_video" placeholder="Enter video URL">
    </div>
    <div id="document" style="display:none;">
        <label for="contenu_document">Course Document</label>
        <textarea id="contenu_document" name="contenu_document" rows="4" placeholder="Enter course document"></textarea>
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
                <?php foreach ($tags as $tag): ?>
                    <div>
                <table>
                       <td> <label for="tag_<?= $tag['id'] ?>"><?= htmlspecialchars($tag['name']) ?></label></td>
                       <td> <input type="checkbox" id="tag_<?= $tag['id'] ?>" name="tags[]" value="<?= $tag['id'] ?>"></td>
                       
                </table>
                    </div>
                <?php endforeach; ?>
                </div>
    <div>
        <label for="featured_image">Featured Image URL</label>
        <input type="url" id="featured_image" name="featured_image" placeholder="Enter image URL" required>
    </div>
    <div>
        <label for="scheduled_date">Scheduled Date</label>
        <input type="date" id="scheduled_date" name="scheduled_date" required>
    </div>
    <button type="submit" name="action" value="create">Ajouter Course</button>
</form>
            </div>
  <h1>Liste des courses</h1>
  <h2>Cours Vidéo</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>content</th>
                <th>categorie</th>
                <th>Tags</th>
                <th>Video Path</th>
                <th>created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
                    
        <?php 
        
      
        $courses = VideoCourse::displayCourses($pdo,$teacherId);
                    // var_dump($courses);
            foreach($courses as $course) :
        ?>

        <tr>
            <td><?= $course['title'];  ?></td>
            <td><?= $course['contenu'];  ?></td>
            <td><?= $course['category_name'];  ?></td>
            <td><?= $course['tags'];  ?></td>
            <td><?= $course['video_path'];  ?></td>
            <td><?= $course['created_at'];  ?></td>
            <td>
                <form method='GET' action='../controller/CourseController.php' style='display:inline;'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='hidden' name='id' value='<?= $course['id'] ?>'>
                    <button type='submit' name="delete">Supprimer</button>
                </form>
                <form method='GET' action='edit_course.php' style='display:inline;'>
                    <input type='hidden' name='id' value='<?= $course['id'] ?>'>
                    <button type='submit'>Modifier</button>
                </form>
            </td>
        </tr>
         <!-- ajouter les cours video dynamiquement -->
          <?php endforeach;?>
        </tbody>
    </table>

    <h2>Cours Document</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>content</th>
                <th>Categorie</th>
                <th>Tags</th>
                <th>Document Path</th>
                <th>created at</th>
                <th>Action</th>
            </tr>
            </thead>
        <tbody>
                    
        <?php 
        $courses = DocumentCourse::displayCourses($pdo,$teacherId);
                    // var_dump($courses);
            foreach($courses as $course) :
        ?>

            <tr>
            <td><?= $course['title'];  ?></td>
            <td><?= $course['contenu'];  ?></td>
            <td><?= $course['category_name'];  ?></td>
            <td><?= $course['tags'];  ?></td>
            <td><?= $course['document_path'];  ?></td>
            <td><?= $course['created_at'];  ?></td>
            <td>
                <form method='GET' action='../controller/CourseController.php' style='display:inline;'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='hidden' name='id' value='<?= $course['id'] ?>'>
                    <button type='submit' name="supprimer-course">Supprimer</button>
                </form>
                <form method='GET' action='edit_course.php' style='display:inline;'>
                    <input type='hidden' name='id' value='<?= $course['id'] ?>'>
                    <button type='submit'>Modifier</button>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
        </thead>
        <tbody>

        
        
          <!-- ajouter les cours doucument dynamiquement -->
        </tbody>
    </table>
    <script>
       
        const addArticleBtn = document.getElementById('add-article-btn');
        const formContainer = document.getElementById('form-container');
        const submitBtn = document.getElementById('submit-btn');

        
        addArticleBtn.addEventListener('click', () => {
            formContainer.style.display = 'block'; 
            addArticleBtn.style.display = 'none'; 
        });

        // submitBtn.addEventListener('click', () => {
        //     formContainer.style.display = 'none';
        //     addArticleBtn.style.display = 'block'; 
        // });

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
