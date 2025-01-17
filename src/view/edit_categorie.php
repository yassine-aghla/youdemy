<?php
require_once '../../vendor/autoload.php';
require __DIR__.'/../controller/categoriesController.php';
use App\Model\category;
session_start();
$role = $_SESSION['user']['role'];
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
        form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width:300px;
 

  }
  .form-container{
    width:500px;
    margin:auto;
    margin-bottom:30px;
  }
  form label {
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  form input[type="text"] {
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    font-size: 16px;
  }
  
  form button {
    background-color:#2a2185;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }
  
  form button:hover {
    background-color:#2a2185;
  }
  </style>
  <?php
if (isset($_GET['id'])) {
    $category = Category::getCategoryById($_GET['id']);
    if (!$category) {
        echo "Catégorie introuvable";
        exit;
    }
} else {
    echo "ID non spécifié";
    exit;
}
?>
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
                <li>
                <?php endif; ?>
                <?php if ($role ==='Enseignant'): ?>v
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
                    <a href="user.php">
                        <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">user</span>
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
      
<h2>Modifier la Catégorie</h2>
<form method="POST" action="categories.php">
    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
    <label for="categoryName">Nom de la Catégorie :</label>
    <input type="text" id="categoryName" name="categoryName" value="<?php echo $category['name']; ?>" required>
    <button type="submit" name="update">Modifier</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
