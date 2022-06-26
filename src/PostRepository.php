<?php

namespace Post;

class PostRepository
{
    public static function store(Post $post)
    {
        return PostMapper::save($post);
    }

    public static function remove(Post $post)
    {
        PostMapper::remove($post);
    }

    public static function getAll()
    {
        return PostMapper::getAll();
    }

    public static function getById($id)
    {
        return PostMapper::getById($id);
    }

    public static function getByFields($title, $content)
    {
        return PostMapper::getByFields($title, $content);
    }
}