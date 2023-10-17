<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';

class AuthController {
    private $view;
    private $model;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function login() {
        $this->view->showLogin();
    }

    public function auth() {
        $user= $_POST['user'];
        $password = $_POST['password'];

        if (empty($user) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        //buscamos el usuario
        $user = $this->model->getByUser($user);
        if ($user && password_verify($password, $user->password)) {
            //ya estamos autenticados
            
            AuthHelper::login($user);
            
            header('Location: ' . BASE_URL . 'albums/list');
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'albums/list');    
    }
}