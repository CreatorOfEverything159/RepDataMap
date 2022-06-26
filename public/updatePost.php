<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Post\Post;
use Post\PostRepository;

$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];

if ($title != '' && $content != '' && $id != '') {
    PostRepository::store(new Post($title, $content, (int)$id));
}
header('Location: /RepDataMap');