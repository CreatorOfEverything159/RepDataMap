<?php

namespace Post;

class PostMapper
{
    public static function save(Post $post)
    {
        $postByFields = self::getByFields($post->getTitle(), $post->getContent());
        if ($post->getId() == null) {
            if (!$postByFields->getId()) {
                $foundPost = PdoAdapter::returnOneRequest('INSERT INTO post(title, content) VALUES(:title,:content)',
                    ['title' => $post->getTitle(), 'content' => $post->getContent()]);
                return new Post($foundPost['title'], $foundPost['content'], $foundPost['id']);
            } return false;
        } else {
            if ($postByFields->getTitle() != $post->getTitle() && $postByFields->getContent() != $post->getContent()) {
                PdoAdapter::noReturnRequest('UPDATE post set title=:title, content=:content WHERE id=:id',
                    ['title' => $post->getTitle(), 'content' => $post->getContent(), 'id' => $post->getId()]);
                return self::getById($post->getId());
            } return false;
        }
    }

    public static function remove($post)
    {
        if (PostMapper::getById($post->getId())->getId()) {
            PdoAdapter::noReturnRequest('DELETE FROM post WHERE id=?', [$post->getId()]);
        }
    }

    public static function getAll()
    {
        $posts = [];
        $rows = PdoAdapter::returnAllRequest('SELECT * from post ORDER BY id DESC');
        foreach ($rows as $row) {
            $posts[] = new Post(
                (string)$row['title'],
                (string)$row['content'],
                (int)$row['id']);
        }
        return $posts;
    }

    public static function getById($id)
    {
        $foundPost = PdoAdapter::returnOneRequest('SELECT * FROM post WHERE id=?', [$id]);
        if ($foundPost == false)
            return new Post();
        return new Post($foundPost['title'], $foundPost['content'], $foundPost['id']);
    }

    public static function getByFields($title, $content)
    {
        $foundPost = PdoAdapter::returnOneRequest('SELECT * from post where title=:title AND content=:content',
            ['title' => $title, 'content' => $content]);
        if (!$foundPost)
            return new Post();
        return new Post($foundPost['title'], $foundPost['content'], $foundPost['id']);
    }
}