<?php

namespace App\Model;

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
}
