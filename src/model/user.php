<?php
namespace App\Model;

use App\Config\Database;
use PDO;

abstract class User {
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    

    public function __construct($username, $email, $password, $role) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    
    abstract public function signup();

  
    public static function login($email, $password) {
        $conn = Database::getConnection();
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['is_active'] == 0 && $user['role'] !== 'Enseignant' ) {
                echo "Votre compte est banni. Contactez l'administrateur pour plus d'informations.";
                exit;
            }
        }
        if ($user['role'] === 'Enseignant' && $user['is_active'] == false) {
            echo "Votre compte est en attente de validation. Veuillez contacter l'administrateur.";
            exit;
        }

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ];
            return true;
        }
        return false;
    }
    public static function getAllUsers(){
        $conn = Database::getConnection();
        $query = "SELECT * FROM users  ";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function activateUser($userId) {
        $conn = Database::getConnection();
        $query = "UPDATE users SET is_active = true WHERE id = :id";
        $stmt = $conn->prepare($query);
        return $stmt->execute([':id' => $userId]);
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
