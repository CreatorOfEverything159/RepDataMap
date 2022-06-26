<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Post\Post;
use Post\PostRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

$post = $_POST['title'];
$id = $_POST['id'];
$content = $_POST['content'];

try {
    if (isset($_POST['id'])) {
        $post = PostRepository::getById($_POST['id']);
        $loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
        $view = new Environment($loader);
        try {
            echo $view->render('updatePost.twig', ['post' => $post]);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            echo $e;
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}