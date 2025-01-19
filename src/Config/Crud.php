<?php
namespace App\Config;

use App\Config\Database;
use PDO;
// require_once __DIR__ .'/Database.php';

class Crud {
    private static $conn;
  
    
    public static function insert($table, $data) {
        $conn = Database::getConnection();
        
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }



    // READ
    public static function select($table, $columns = "*", $conditions = null) {
        $conn = Database::getConnection();
         
        $query = "SELECT $columns FROM $table";
        if ($conditions) {
            $query .= " WHERE $conditions";
        }
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public static function update($table, $data, $conditions) {
        $conn = Database::getConnection();
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fieldsString = implode(", ", $fields);

        $query = "UPDATE $table SET $fieldsString WHERE $conditions";
        $stmt =$conn->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }

        return $stmt->execute();
    }

    // DELETE
    public static function delete($table, $conditions) {
        $conn = Database::getConnection();
        $query = "DELETE FROM $table WHERE $conditions";
        $stmt =$conn->prepare($query);

        return $stmt->execute();
    }


    public static function insertMultiple($table, $columns, $values) {
        $conn = Database::getConnection();
        
     
        $placeholders = implode(", ", array_fill(0, count($values), "(" . implode(", ", array_fill(0, count($columns), "?")) . ")"));
    
        $columnsString = implode(", ", $columns);
    
        $query = "INSERT INTO $table ($columnsString) VALUES $placeholders";
    
        $stmt = $conn->prepare($query);
    
      
        $flattenedValues = [];
        foreach ($values as $row) {
            foreach ($row as $value) {
                $flattenedValues[] = $value;
            }
        }
    
        return $stmt->execute($flattenedValues);
    }
 
}