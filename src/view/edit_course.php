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