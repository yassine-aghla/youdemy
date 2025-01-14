<?php

include __DIR__.'/../core/crud.php';
class Tag {
    private static $table='tags';
    private static $column='name';

    public static function addTag($name)
    {
        return crud::insert('tags', ['name' => $name]);
    }
    public static function getAllTags()
    {
        return crud::select('tags');
    }
}