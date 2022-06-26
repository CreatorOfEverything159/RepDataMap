<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Post\Post;
use Post\PostRepository;

$post = $_POST['title'];
$content = $_POST['content'];

if ($post != '' && $_POST['content'] != '') {
    PostRepository::store(new Post($post, $content));
}
header('Location: /RepDataMap');
