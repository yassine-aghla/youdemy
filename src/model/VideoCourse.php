<?php
namespace App\Model;

class VideoCourse extends Course
{
    private $video_path;

    public function __construct($title, $description, $category_id, $tags, $video_path,$content)
    {
        parent::__construct($title, $description, $category_id, $tags,$content);
        $this->video_path = $video_path;
    }

    public function save($pdo)
    {
        $stmt = $pdo->prepare("
            INSERT INTO courses (title, description, category_id, video_path, created_at, contenu)
            VALUES (:title, :description, :category_id, :video_path, :created_at, :contenu)
        ");
        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':category_id' => $this->category_id,
            ':video_path' => $this->video_path,
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
