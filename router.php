<?php
require_once './app/config/config.php';
require_once './app/controllers/album.controller.php';
require_once './app/controllers/song.controller.php';
require_once './app/controllers/auth.controller.php';

$action = 'albums'; //accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

//parsea la action para separar accion de parametros
function parseUrl($url) {
    $url_data = explode("/", $url);
    $url_action = explode("-", $url_data[0]);

    $arrayReturn['category'] = $url_action[0];
    $arrayReturn['fullaction'] = $url_data[0];
    $arrayReturn['id'] = isset($url_data[1]) && $url_data[1] != "" ? $url_data[1] : null;

    return $arrayReturn;
}

/*                                  --- TABLA DE ROUTING ---

albums              ->      AlbumController()->list();          -Lista todos los albumes
albums/id           ->      AlbumController()->list($id);       -Lista el detalle de un album
albums-save         ->      AlbumController()->save();          -Guarda un nuevo album desde el form de alta
albums-edit/id      ->      AlbumController()->edit($id);       -Carga el form de edicion
albums-save/id      ->      AlbumController()->save($id);       -Guarda modificaciones a un album desde el form de edicion
albums-remove/id    ->      AlbumController()->remove($id);     -Elimina un album si no tiene dependencias, de tenerlas da la eleccion al usuario
albums-rmvall/id    ->      AlbumController()->rmvall($id);     -Elimina un album y todas sus dependencias 

songs               ->      SongController()->list();           -Lista todas las canciones
songs/id            ->      SongController()->list($id);        -Lista el detalle de una cancion
songs-save          ->      SongController()->save();           -Guarda una nueva cancion desde el form de alta
songs-edit/id       ->      SongController()->edit($id);        -Carga el form de edicion
songs-save/id       ->      SongController()->save($id);        -Guarda modificaciones a una cancion desde el form de edicion
songs-remove/id     ->      SongController()->remove($id);      -Elimina una cancion

login               ->      AuthController()->login();          -Muestra la seccion de login
auth                ->      AuthController()->auth();           -Autentica al usuario
logout              ->      AuthController()->logout();         -Desloguea al usuario
default             ->      Controller->showError($error=null); -Muestra un error, por defecto 404

*/

$params = parseUrl($action);
$contr;

switch ($params['category']) {
    case 'albums':  $contr = new AlbumController(); break;
    case 'songs':   $contr = new SongController();  break;
    case 'login':
    case 'auth':
    case 'logout':  $contr = new AuthController();  break;

    default:        $contr = new Controller();
                    $contr->showError();
}

switch ($params['fullaction']) {
    case 'albums':          $contr->list($params['id']);    break;
    case 'albums-save':     $contr->save($params['id']);    break;
    case 'albums-edit':     $contr->edit($params['id']);    break;
    case 'albums-remove':   $contr->remove($params['id']);  break;
    case 'albums-rmvall':   $contr->rmvall($params['id']);  break;
    
    case 'songs':           $contr->list($params['id']);    break;
    case 'songs-save':      $contr->save($params['id']);    break;
    case 'songs-edit':      $contr->edit($params['id']);    break;
    case 'songs-remove':    $contr->remove($params['id']);  break;

    case 'login':           $contr->login();                break;
    case 'auth':            $contr->auth();                 break;
    case 'logout';          $contr->logout();               break;

    default:                $contr->showError();
}