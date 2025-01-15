
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../assets/style.css">
    <style>

form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #2d3748;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    input, textarea, select, button {
        width: 100%;
        padding: 10px;
        border: 1px solid #4a5568;
        border-radius: 6px;
        background-color: #4a5568;
        color: #fff;
        font-size: 1rem;
        margin-bottom: 20px;
        box-sizing: border-box;
    }
    input:focus, textarea:focus, select:focus {
        border-color: #63b3ed;
        outline: none;
        box-shadow: 0 0 0 2px rgba(99, 179, 237, 0.5);
    }
    button {
        background-color: #ecc94b;
        border: none;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #d69e2e;
    }
    .text-sm {
        font-size: 0.875rem;
        color: #a0aec0;
        margin-top: -10px;
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
                    <a href="dashboard.php">
                        <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title"><?php echo$_SESSION['user']['username'];?></span>
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
  <!-- =============== formualire ================ -->

  <button id="add-article-btn">Add Article</button>
  
  <form action="" method="POST">
     <h2>Ajouter un course</h2>
    <div>
        <label for="title">Course Title</label>
        <input type="text" id="title" name="title" placeholder="Enter course title" required>
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
    <div id="document">
        <label for="contenu_document">Course Document</label>
        <textarea id="contenu_document" name="contenu_document" rows="4" placeholder="Enter course document"></textarea>
    </div>
    <div>
        <label for="categorie">Category</label>
        <select id="categorie" name="categorie" required>
            <option value="">-- Please choose a category --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="tags">Tags</label>
        <select id="tags" name="tags[]" multiple>
            <?php foreach ($tags as $tag): ?>
                <option value="<?php echo htmlspecialchars($tag['id']); ?>">
                    <?php echo htmlspecialchars($tag['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="text-sm">Hold down the Ctrl (Windows) or Command (Mac) key to select multiple tags.</p>
    </div>
    <div>
        <label for="featured_image">Featured Image URL</label>
        <input type="url" id="featured_image" name="featured_image" placeholder="Enter image URL" required>
    </div>
    <div>
        <label for="scheduled_date">Scheduled Date</label>
        <input type="date" id="scheduled_date" name="scheduled_date" required>
    </div>
    <button type="submit">Ajouter Course</button>
</form>

  <h1>Liste des Articles</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Extrait</th>
                <!-- <th>Statut</th> -->
                <th>Date de Programmation</th>
                <th>Catégorie</th>
                <th>Auteur</th>
                <th>Date de Création</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article['id']) ?></td>
                        <td><?= htmlspecialchars($article['title']) ?></td>
                        <td><?= htmlspecialchars($article['excerpt']) ?></td>
                        <!-- <td>
                            <?= htmlspecialchars($article['status']) ?>
                        </td> -->
                        <td><?= htmlspecialchars($article['scheduled_date'] ?: 'Non programmé') ?></td>
                        <td><?= htmlspecialchars($article['category_name']) ?></td>
                        <td><?= htmlspecialchars($article['author_name']) ?></td>
                        <td><?= htmlspecialchars($article['created_at']) ?></td>
                        <td>
                            <?php if ($article['featured_image']): ?>
                                <img src="<?= htmlspecialchars($article['featured_image']) ?>" alt="Image" style="width: 60px; height: auto;">
                            <?php else: ?>
                                Aucune image
                            <?php endif; ?>

                        </td>
                        <td><?= htmlspecialchars($article['tag_names'] ?: 'Aucun tag') ?></td>
                        <td>
                            <a href="edit_article.php?id=<?= $article['id'] ?>">Modifier</a> |
                            <a href="delete_article.php?id=<?= $article['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Aucun article trouvé.</td>
                </tr>
            <?php endif; ?>
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

        
        submitBtn.addEventListener('click', () => {
            formContainer.style.display = 'none';
            addArticleBtn.style.display = 'block'; 
        });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
