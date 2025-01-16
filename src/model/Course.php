<?php

namespace App\Model;

abstract class Course
{
    protected $id;
    protected $title;
    protected $description;
    protected $category_id;
    protected $tags;
    protected $created_at;
    protected $content;

    public function __construct($title, $description, $category_id, $tags, $content)
    {
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->tags = $tags;
        $this->created_at = date('Y-m-d H:i:s');
        $this->content = $content;
    }

    abstract public function save($pdo);

    abstract static public function displayCourses($pdo);
}
