<?php

namespace Post;

class Post
{
    private ?int $id;
    private ?string $title;
    private ?string $content;

    public function __construct($title = null, $content = null, $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getId()
    {
        return $this->id;
    }
}