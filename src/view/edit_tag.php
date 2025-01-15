<?php
require_once '../../vendor/autoload.php';
require __DIR__.'/../controller/tags.php';
use App\Model\Tag;
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
    $tag = Tag::getTagById($_GET['id']);
    if (!$tag) {
        echo "Tag introuvable";
        exit;
    }
} else {
    echo "ID non spécifié";
    exit;
}
?>
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

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="Articles.php">
                        <span class="icon">
                        <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Articles</span>
                    </a>
                </li>
              
               
                <li>
                    <a href="categories.php">
                        <span class="icon">
                           <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="title">Categories</span>
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
      
<h2>Modifier le Tag</h2>
<form method="POST" action="tags.php">
    <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
    <label for="tagName">Nom du Tag :</label>
    <input type="text" id="tagName" name="tagName" value="<?php echo $tag['name']; ?>" required>
    <button type="submit" name="update">Modifier</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>