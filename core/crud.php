<?php


require_once __DIR__.'/../config/Database.php';

class crud {
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
 
    
}