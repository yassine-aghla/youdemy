<?php
// require_once __DIR__.'/../model/Category.php';
namespace App\Controller;

use App\Model\Category;
class CategoriesController extends Category  {

    public  function handleRequest() {
   
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryName = $_POST['categoryName'];
            $this->addCategory($categoryName);
            header("Location: categories.php");
            exit;
        }

       
        if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['categoryName'])) {
            $categoryId = $_POST['id'];
            $categoryName = $_POST['categoryName'];
            $this->updateCategory($categoryId, $categoryName);
            header("Location: categories.php");
            exit;
        }

        
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $categoryId = $_GET['id'];
            $this->deleteCategory($categoryId);
            header("Location: categories.php");
            exit;
        }
    }

    public function displayCategories() {
        return   $this->getAllCategories();
    }
    public  function getCategoryCount() {
        return   $this->countCategories();
    }
  
}


$categorie=new CategoriesController();
$categorie->handleRequest();
$categories=$categorie->displayCategories();
?>