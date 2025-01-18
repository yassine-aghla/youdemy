<?php
namespace App\Config;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $conn = Database::getConnection();
        $query = "UPDATE users SET is_active = false WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
             header("Location:../view/users.php");
            echo "Utilisateur banni avec succès.";
        } else {
            echo "Erreur lors du bannissement de l'utilisateur.";
        }
    }
}
?>
