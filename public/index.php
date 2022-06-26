<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Post\PostRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

function renderPage($data)
{
    $loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
    $view = new Environment($loader);
    try {
        echo $view->render('index.twig', ['posts' => $data ?? array()]);
    } catch (LoaderError|RuntimeError|SyntaxError $e) {
        echo $e;
    }
}

try {
    renderPage(PostRepository::getAll());
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}