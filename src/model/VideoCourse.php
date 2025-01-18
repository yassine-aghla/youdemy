<?php

namespace App\Model;

class VideoCourse extends Course
{
    private $video_path;


    public function __construct($title, $description, $category_id, $teacher_id,$tags, $video_path, $content)
    {
        parent::__construct($title, $description, $category_id, $teacher_id ,$tags, $content);
        $this->video_path = $video_path;
    }

    public function save($pdo)
    {
        $stmt = $pdo->prepare("
            INSERT INTO courses (title, description, category_id,teacher_id ,video_path, created_at, contenu)
            VALUES (:title, :description, :category_id, :teacher_id ,:video_path, :created_at, :contenu)
        ");
        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':category_id' => $this->category_id,
            ':teacher_id'=> $this->teacher_id,
            ':video_path' => $this->video_path,
            ':created_at' => $this->created_at,
            ':contenu' => $this->content,

        ]);

        $course_id = $pdo->lastInsertId();
        $this->id = $course_id;
        $this->saveTags($pdo, $course_id);
    }

    private function saveTags($pdo, $course_id)
    {
        $stmt = $pdo->prepare("INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)");
        foreach ($this->tags as $tag) {
            $stmt->execute([
                ':course_id' => $course_id,
                ':tag_id' => $tag,
            ]);
        }
    }

    public static function displayCourses($pdo, $teacherId = null)
    {
        $query = "
            SELECT 
                courses.id, 
                courses.title, 
                courses.contenu, 
                c.name AS category_name, 
                GROUP_CONCAT(tags.name ORDER BY tags.name ASC) AS tags, 
                courses.video_path, 
                courses.created_at 
            FROM 
                courses
            LEFT JOIN 
                categories c ON c.id = courses.category_id
            LEFT JOIN 
                course_tags ON course_tags.course_id = courses.id
            LEFT JOIN 
                tags ON tags.id = course_tags.tag_id
            WHERE 
                courses.document_path IS NULL 
                AND courses.video_path IS NOT NULL
        ";
    
      
        if ($teacherId !== null) {
            $query .= " AND courses.teacher_id = :teacher_id";
        }
    
        $query .= " GROUP BY courses.id, c.id";
    
        $stmt = $pdo->prepare($query);
    
       
        if ($teacherId !== null) {
            $stmt->bindParam(':teacher_id', $teacherId);
        }
    
        $stmt->execute();
        $result = $stmt->fetchAll();
    
        return $result ?: [];
    }
    
}