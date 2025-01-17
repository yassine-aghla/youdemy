<?php
namespace App\Config;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $conn = Database::getConnection();
        $query = "UPDATE users SET is_active = 1 WHERE id = :id";  
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
           
            header("Location: ../view/users.php"); 
            exit;
        } else {
            echo "Erreur lors de l'activation de l'utilisateur.";
        }
    }
}
