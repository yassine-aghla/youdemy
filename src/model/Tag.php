<?php
namespace App\Model;

use App\Config\Crud;

// require_once __DIR__.'/../config/crud.php';
class Tag {
    private static $table='tags';
    private static $column='name';

    public static function createTag($name)
    {
        return Crud::insert('tags', ['name' => $name]);
    }
    public static function getAllTags()
    {
        return Crud::select('tags');
    }
    public static function getTagById($id) {
        return Crud::select('tags', '*', "id = $id")[0] ?? null;
    }
    public static function updateTag($id, $name) {
        return Crud::update('tags', ['name' => $name], "id = $id");
    }
    public static function deleteTag($id) {
        return Crud::delete('tags', "id = $id");
    }
    public static function countTags() {
        $result = crud::select(self::$table, "COUNT(*) as total");
        return $result[0]['total'] ?? 0;
    }
    public static function createMultipleTags($tags) {
        $data = [];
        foreach ($tags as $tag) {
            $data[] = [$tag];
        }
        return Crud::insertMultiple('tags', ['name'], $data);
    }
}
?>