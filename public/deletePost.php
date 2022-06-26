<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Post\PostRepository;

$id = $_POST['id'];

if ($id != '') {
    PostRepository::remove(PostRepository::getById($id));
}
header('Location: /RepDataMap');
