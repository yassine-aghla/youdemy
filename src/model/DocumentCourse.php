<?php
namespace App\Model;

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Model\Course;

class DocumentCourse extends Course
{
    private $document_path;

    public function __construct($title, $description, $category_id, $tags, $document_path,$content)
    {
        parent::__construct($title, $description, $category_id, $tags,$content);
        $this->document_path = $document_path;
    }

    public function save($pdo)
    {
        $stmt = $pdo->prepare("
            INSERT INTO courses (title, description, category_id, document_path, created_at, contenu)
            VALUES (:title, :description, :category_id, :document_path, :created_at, :contenu)
        ");
        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':category_id' => $this->category_id,
            ':document_path' => $this->document_path,
            ':created_at' => $this->created_at,
            ':contenu' => $this->content,
        ]);

        $course_id = $pdo->lastInsertId();
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
}
