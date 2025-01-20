<?php
require_once '../../vendor/autoload.php';
require_once __DIR__.'/../controller/tags.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !=='Admin') {
    header('Location:../../public/index.php');
    exit();
}
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['user']['role'];
// use App\Controller\tags;
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
    width: 35%;
  }
  
  form button:hover {
    background-color:#2a2185;
  }
  
  .table-container {
    margin-top: 20px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  table th,
  table td {
    text-align: left;
    padding: 10px;
    border: 1px solid #dddddd;
  }
  
  table th {
    background-color:#2a2185;
    color: white;
  }
  
  table tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  table tr:hover {
    background-color: #f1f1f1;
  }
  
  table a {
    color:#2a2185;
    text-decoration: none;
    margin-right: 10px;
    
  }
  
  table a:hover {
    text-decoration: none;
  }
  .delete {
  border: 2px solid red; 
  padding: 5px 10px; 
  border-radius: 5px; 
  color: red; 
  background-color: #ffe6e6; 
  text-decoration: none; 
}

.delete:hover {
  background-color: red;
  color: white; 
}

.update {
  border: 2px solid green; 
  padding: 5px 10px; 
  border-radius: 5px; 
  color: green; 
  background-color: #e6ffe6;
  text-decoration: none; 
}

.update:hover {
  background-color: green;
  color: white; 
}
.tags-preview h3 {
    margin-bottom: 10px;
}
.tags-preview span {
    background-color: #f0f0f0;
    color: #333;
    border-radius: 5px;
    padding: 5px 10px;
    margin-right: 5px;
    margin-bottom: 5px;
    display: inline-block;
    font-size: 14px;
    cursor: pointer;
}
.tags-preview span:hover {
    background-color: #ddd;
    text-decoration: line-through;
}

.form-container {
    width: 100%;
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}


.form-container label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
    display: block;
    color: #333;
}


.form-container input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 15px;
    outline: none;
    transition: border-color 0.3s ease;
}

.form-container input[type="text"]:focus {
    border-color:#2a2185; 
}


.form-container button {
    background-color:#2a2185; 
    color: #fff;
    padding: 10px 20px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.form-container button:hover {
    background-color:#2a2185; 
    transform: scale(1.05); 
}

.form-container button:active {
    transform: scale(0.98); 
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
                        <span class="title">Courses</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                <?php if ($role==='Admin'): ?>
                    <a href="categories.php">
                        <span class="icon">
                           <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="title">Categorie</span>
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
      <!-- affichage  -->
            <div class="container">
    
            <div class="container">
    <div class="form-container">
        <label for="tagInput">Nom du Tag :</label>
        <input type="text" id="tagInput" placeholder="Entrez un tag" />
        <button type="button" id="addTagButton">Ajouter au cadre</button>
    </div>

    <div class="tags-preview">
        <h3>Tags ajoutés :</h3>
        <div id="tagsFrame" style="border: 1px solid #ddd; padding: 10px; min-height: 50px;">
           
        </div>
    </div>

    <form id="submitTagsForm" method="POST">
        <input type="hidden" name="tags" id="tagsInput" />
        <button type="submit" name="submit">Insérer tous les tags</button>
    </form>
</div>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Id du Tag</th>
                <th>Nom du Tag</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tagTableBody">
            <?php
           
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    echo "<tr>
                            <td>{$tag['id']}</td>
                            <td>{$tag['name']}</td>
                            <td>
                                <a class='update' href='edit_tag.php?id={$tag['id']}'>Modifier</a>
                                 <a class='delete' href='tags.php?action=delete&id={$tag['id']}'>Supprimer</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Aucun tag trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

    </div>
  </div>
  <script src="dashboard.js"></script>
   <script>
    const tagInput = document.getElementById("tagInput");
    const addTagButton = document.getElementById("addTagButton");
    const tagsFrame = document.getElementById("tagsFrame");
    const tagsInput = document.getElementById("tagsInput");
    let tags = [];

    
    addTagButton.addEventListener("click", () => {
        const tagName = tagInput.value.trim();
        if (tagName && !tags.includes(tagName)) {
            tags.push(tagName);

    
            const tagElement = document.createElement("span");
            tagElement.textContent = tagName;
            tagElement.style.marginRight = "10px";
            tagElement.style.padding = "5px";
            tagElement.style.border = "1px solid #333";
            tagElement.style.display = "inline-block";
            tagElement.style.cursor = "pointer";
            tagElement.title = "Cliquez pour supprimer";

           
            tagElement.addEventListener("click", () => {
                tags = tags.filter(tag => tag !== tagName);
                tagsFrame.removeChild(tagElement);
            });

            tagsFrame.appendChild(tagElement);
        }
        tagInput.value = ""; 
        tagsInput.value = tags.join(","); 
    });

    </script>

   <!-- ======= Charts JS ====== -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
