<?php
require_once './app/controllers/album.controller.php';
require_once './app/controllers/song.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'albums'; //acction por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

//parsea la action para separar accion de parametros
function parseUrl($url) {
    $url_data = explode("/", $url);

    //guardamos la categoria que sera afectada por la accion
    $arrayReturn['category'] = $url_data[0];
    //guardamos la accion en si, en caso de que este vacia sera null
    $arrayReturn['action'] = isset($url_data[1]) && $url_data[1] != "" ? $url_data[1] : null;
    //guardamos el id en caso de que exista, sino null
    $arrayReturn['id'] = isset($url_data[2]) && $url_data[2] != "" ? $url_data[2] : null;

    return $arrayReturn;
}

$params = parseUrl($action);
$controller;

switch ($params['category']) {
    case 'albums':  $controller = new AlbumController();    break;
    case 'songs':   $controller = new SongController();     break;
    case 'login':   $controller = new AuthController();     break;

    default: echo "404 error de categoria";
}

switch ($params['action']) {
    case 'list':    $controller->list   ($params['id']);    break;
    case 'save':    $controller->save   ($params['id']);    break;
    case 'remove':  $controller->remove ($params['id']);    break;
    case 'edit':    $controller->edit   ($params['id']);    break;

    default: echo "404 implementar pls";
}