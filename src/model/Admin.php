<?php
namespace App\Model;

use App\Config\Database;
use PDO;

class Admin extends User {

    public function signup() {
        $conn = Database::getConnection();
        $query = "INSERT INTO users (username, email, password, role) 
                  VALUES (:username, :email, :password, :role)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_BCRYPT),
            ':role' => 'Admin'
        ]);
    }



    public static function getAdminStats() {
        $conn = Database::getConnection();
    
        
        $queryCourse = "
            SELECT c.title, COUNT(e.id) AS total_students
            FROM courses c
            JOIN enrollments e ON c.id = e.course_id
            GROUP BY c.id
            ORDER BY total_students DESC
            LIMIT 1;
        ";
        $stmtCourse = $conn->prepare($queryCourse);
        $stmtCourse->execute();
        $topCourse = $stmtCourse->fetch(PDO::FETCH_ASSOC);
    
       
        $queryTeachers = "
            SELECT u.username AS teacher_name, COUNT(e.id) AS total_students
            FROM users u
            JOIN courses c ON u.id = c.teacher_id
            JOIN enrollments e ON c.id = e.course_id
            WHERE u.role = 'Enseignant'
            GROUP BY u.id
            ORDER BY total_students DESC
            LIMIT 3;
        ";
        $stmtTeachers = $conn->prepare($queryTeachers);
        $stmtTeachers->execute();
        $topTeachers = $stmtTeachers->fetchAll(PDO::FETCH_ASSOC);
    
        return [
            'top_course' => $topCourse,
            'top_teachers' => $topTeachers
        ];
    }
    public static function getCoursesByCategory() {
        $conn = Database::getConnection();
        $query = "
            SELECT cat.name AS category_name, COUNT(c.id) AS total_courses
            FROM categories cat
            LEFT JOIN courses c ON cat.id = c.category_id
            GROUP BY cat.id;
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}