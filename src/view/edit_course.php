<?php
require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../Controller/CourseController.php';
use App\Config\Database;


use App\Controller\tags;
use App\Controller\CategoriesController;
use App\Model\VideoCourse;
// use App\Controller\CourseController;

$pdo = Database::getConnection();
$tag=new tags();
$tags=$tag->displayTags();
$categorie=new CategoriesController();
$categories=$categorie->displayCategories();

// Connexion à la base de données
$pdo = Database::getConnection();

// Récupérer l'ID du cour
var_dump($_GET);
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = :id");
$stmt->execute([':id' => $id]);
$course = $stmt->fetch();

if (!$course) {
    echo "Cours introuvable.";
    exit;
}
?>

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
    <button type="submit" name="update-course" value="update">Ajouter Course</button>
</form>
