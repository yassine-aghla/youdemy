<?php
namespace App\Controller;

use App\Model\Tag;
// require_once __DIR__.'/../model/Tag.php';
class tags extends Tag{
    public  function addTag(){
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $tagname=$_POST['tagName'];
           $this->createTag($tagname);
            
        }
        // modifier un tag
        if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['tagName'])) {
            $tagId = $_POST['id'];
            $tagName = $_POST['tagName'];
            $this->updateTag($tagId, $tagName);  
            header("Location: tags.php");  
            exit;
        }

        // Supprimer un tag
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $tagId = $_GET['id'];
            $this->deleteTag($tagId);  
            header("Location: tags.php"); 
            exit;
        }
    }
    public  function displayTags()
    {
        $tags = $this->getAllTags();
        return $tags;
    }

    public function getCountTags(){
        $tagsCount=$this->countTags();
     return  $tagsCount;
    }
}



$tag=new tags();
$tag->addTag();
$tags=$tag->displayTags();
$tagsCount=$tag->getCountTags();