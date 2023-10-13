<?php
require_once './app/controllers/music.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'list'; //acction por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

//list      ->          musicController->showMusic();
//add       ->          musicController->addMusic();
//remove    ->          musicController->removeMusic();
//edit      ->          musicController->editMusic();
//cancel    ->          musicController->cancelEdit();
//save      ->          musicController->saveEdit();

//parsea la acction para separar accion de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'list':
        $controller = new MusicController();
        $controller->listMusic();
        break;
    case 'add':
        $controller = new MusicController();
        $controller->addMusic();
        break;
    case 'remove':
        $controller = new MusicController();
        $controller->removeMusic($params[1]);
        break;
    case 'edit':
        $controller = new MusicController();
        $controller->editMusic($params[1]);
        break;
    case 'cancel':
        $controller = new MusicController();
        $controller->cancelEdit();
        break;
    case 'save':
        $controller = new MusicController();
        $controller->saveEdit($params[1]);
    default:
    // no dejar sin corregir
        echo "404 IMPLEMENTAR PLS";
}
