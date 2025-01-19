<?php
namespace App\Model;

use App\Config\Database;
use PDO;

class Student extends User {
    public function signup() {
        $conn = Database::getConnection();
        $query = "INSERT INTO users (username, email, password, role,is_active) 
                  VALUES (:username, :email, :password, :role, :is_active)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_BCRYPT),
            ':role' => 'Etudiant',
            ':is_active'=>true
        ]);
    }
    public static function enrollToCourse($studentId, $courseId) {
        $conn = Database::getConnection();
        $query = "INSERT INTO enrollments (student_id, course_id) VALUES (:student_id, :course_id)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId
        ]);
    }
    public static function getEnrolledCourses($studentId) {
        $conn = Database::getConnection();
        $query = "SELECT c.id, c.title, c.contenu, c.description, c.video_path, c.document_path, c.photo_url, c.price, 
                         u.username AS teacher_name, u.email AS teacher_email, cat.name AS category_name
                  FROM courses c
                  LEFT JOIN users u ON c.teacher_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  JOIN enrollments e ON c.id = e.course_id
                  WHERE e.student_id = :student_id";
        $stmt = $conn->prepare($query);
        $stmt->execute([':student_id' => $studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
