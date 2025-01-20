<?php
require_once '../../vendor/autoload.php';
require_once __DIR__ . '/../Controller/CourseController.php';
use App\Controller\UsersController;
 $users = UsersController::getUsers();

//  session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !=='Admin') {
    header('Location:../../public/index.php');
    exit();
}
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['user']['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
     
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color:#2a2185;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}


button {
    background-color: #007bff;
    border: none;
    padding: 8px 12px;
    color: white;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

button:hover {
    background-color: #0056b3;
}


button i {
    font-size: 18px; 
}


button.delete {
    background-color: #dc3545;
}

button.delete:hover {
    background-color: #c82333;
}

button.ban {
    background-color: #f0ad4e;
}

button.ban:hover {
    background-color: #ec971f;
}

button.activate {
    background-color: #28a745;
}

button.activate:hover {
    background-color: #218838;
}

    </style>
</head>
<body>
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
                        <ion-icon name="school"></ion-icon>
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
                        <span class="title">user</span>
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


    <h1>Liste des utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>statuts</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td><?php  if ($user['is_active'] == 0) {
                    echo "Banni ";
                    }else{
                        echo "actif";
                    } ?></td>
                    <td>
                    <!-- Supprimer -->
                    <form action="..\controller\delete_user.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="delete"></i>
                        Supprimer</button>
                    </form>

                    <!-- Banner -->
                    <form action="..\controller\ban_user.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="ban">
                            Banner</button>
                    </form>

                    <!-- Activer -->
                    <?php 
  
    if ($user['is_active'] == 0) {
        echo "<form action='..\controller\activate_user.php' method='POST' style='display:inline;'>
                  <input type='hidden' name='id' value='" . $user['id'] . "'>
                  <button type='submit'class='activate'>
                  Réactiver</button>
              </form>";
    }
    echo "<br>";
?>
                </td>
                
               
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
