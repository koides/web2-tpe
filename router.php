<?php
require_once './app/config/config.php';
require_once './app/helpers/app.helper.php';
require_once './app/controllers/album.controller.php';
require_once './app/controllers/song.controller.php';
require_once './app/controllers/auth.controller.php';

$action = 'albums/list'; //accion por defecto
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

<<<<<<< HEAD
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
=======
    return $arrayReturn;
>>>>>>> ab0b489aa32fd8e01f4b4ea1530655fb23969a0d
}

$params = parseUrl($action);
$controller;

/*                                  --- TABLA DE ROUTING ---

albums/list         ->      AlbumController()->list();          -Lista todos los albumes
albums/list/id      ->      AlbumController()->list($id);       -Lista el detalle de un album
albums/save         ->      AlbumController()->save();          -Guarda un nuevo album desde el form de alta
albums/edit/id      ->      AlbumController()->edit($id);       -Carga el form de edicion
albums/save/id      ->      AlbumController()->save($id);       -Guarda modificaciones a un album desde el form de edicion
albums/remove/id    ->      AlbumController()->remove($id);     -Elimina un album si no tiene dependencias, de tenerlas da la eleccion al usuario
albums/rmvall/id    ->      AlbumController()->rmvall($id);     -Elimina un album y todas sus dependencias 

songs/list          ->      SongController()->list();           -Lista todas las canciones
songs/list/id       ->      SongController()->list($id);        -Lista el detalle de una cancion
songs/save          ->      SongController()->save();           -Guarda una nueva cancion desde el form de alta
songs/edit/id       ->      SongController()->edit($id);        -Carga el form de edicion
songs/save/id       ->      SongController()->save($id);        -Guarda modificaciones a una cancion desde el form de edicion
songs/remove/id     ->      SongController()->remove($id);      -Elimina una cancion

login               ->      AuthController()->login();          -Muestra la seccion de login
auth                ->      AuthController()->auth();           -Autentica al usuario
logout              ->      AuthController()->logout();         -Desloguea al usuario
notfound            ->      AppHelper::notFound(error);         -Muestra un 404

*/

switch ($params['category']) {
    case 'albums':  $controller = new AlbumController();    break;
    case 'songs':   $controller = new SongController();     break;
    case 'users':   $controller = new AuthController();     break;

    default:   AppHelper::notFound('Pagina no encontrada');
}

switch ($params['action']) {
    case 'list':    $controller->list       ($params['id']);    break;
    case 'save':    $controller->save       ($params['id']);    break;
    case 'remove':  $controller->remove     ($params['id']);    break;
    case 'edit':    $controller->edit       ($params['id']);    break;
    case 'rmvall':  $controller->rmvall     ($params['id']);    break;
    case 'login':   $controller->login      ();                 break;
    case 'auth':    $controller->auth       ();                 break;
    case 'logout':  $controller->logout     ();                 break;

}