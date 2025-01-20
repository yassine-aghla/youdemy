<?php

namespace App\Model;
use App\Config\Database;


abstract class Course
{
    protected $id;
    protected $title;
    protected $description;
    protected $category_id;
    protected $teacher_id;
    protected $tags;
    protected $created_at;
    protected $content;


    public function __construct($title, $description, $category_id, $teacher_id,$tags, $content)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->teacher_id = $teacher_id;
        $this->tags = $tags;
        $this->created_at = date('Y-m-d H:i:s');
        $this->content = $content;
    }

    abstract public function save($pdo);

    abstract static public function displayCourses($pdo,$teacher_id);
    
    public static function countCourses($pdo)
    {
        $query = "SELECT COUNT(*) as total FROM courses";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function getCourseDetails($course_id)
    {
        $conn = Database::getConnection();
        $query = "SELECT 
                    c.id,
                    c.title, 
                    c.contenu, 
                    c.description,
                    c.status,
                    c.video_path,
                    c.document_path,
                    ca.name AS category_name, 
                    users.username AS teacher_name,
                    users.email AS teacher_email,
                    GROUP_CONCAT(tags.name ORDER BY tags.name ASC) AS tags,  
                    c.created_at 
                FROM 
                    courses c
                INNER JOIN 
                    users ON c.teacher_id = users.id
                LEFT JOIN 
                    categories ca ON ca.id = c.category_id
                LEFT JOIN 
                    course_tags ON course_tags.course_id = c.id
                LEFT JOIN 
                    tags ON tags.id = course_tags.tag_id
                WHERE 
                    c.id = :course_id
                GROUP BY 
                    c.id, c.title, c.contenu, c.status, ca.name, users.username, c.created_at;";
        
        $stmt =  $conn->prepare($query);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
}
