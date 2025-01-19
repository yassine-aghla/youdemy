<?php
namespace App\Model;

use App\Config\Database;
use PDO;

class Teacher extends User {
    public function signup() {
        $conn = Database::getConnection();
        $query = "INSERT INTO users (username, email, password, role) 
                  VALUES (:username, :email, :password, :role)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_BCRYPT),
            ':role' => 'Enseignant'
        ]);
    }
    
    public static function getTeacherStats($teacherId) {
        $conn = Database::getConnection();
        
        
        $queryCourses = "SELECT COUNT(*) AS total_courses
                         FROM courses
                         WHERE teacher_id = :teacher_id";
        $stmtCourses = $conn->prepare($queryCourses);
        $stmtCourses->execute([':teacher_id' => $teacherId]);
        $totalCourses = $stmtCourses->fetch(PDO::FETCH_ASSOC)['total_courses'];
        
        
        $queryStudents = "SELECT c.id, c.title, COUNT(e.student_id) AS total_students
                          FROM courses c
                          LEFT JOIN enrollments e ON c.id = e.course_id
                          WHERE c.teacher_id = :teacher_id
                          GROUP BY c.id";
        $stmtStudents = $conn->prepare($queryStudents);
        $stmtStudents->execute([':teacher_id' => $teacherId]);
        $studentsPerCourse = $stmtStudents->fetchAll(PDO::FETCH_ASSOC);
        
        
        return [
            'total_courses' => $totalCourses,
            'students_per_course' => $studentsPerCourse
        ];
    }

}
