<?php
namespace src\controllers;

use \core\Controller;
use src\handlers\getHandler;

class LoginController extends Controller {


    public function login() {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('login', ['flash' => $flash]);
    }

    public function loginAction() {
        $nome = filter_input(INPUT_POST, 'login');
        $senha = filter_input(INPUT_POST, 'senha');

        $login = new GetHandler();
        $login = $login->logar($nome, $senha);
        if ($login) {
            $this->redirect('/');
        } else {
            $this->redirect('/login');
        }
    }

    public function sair() {
        session_destroy();
    }

}