<?php
namespace src\controllers;

use \core\Controller;
use src\handlers\getHandler;

class HomeController extends Controller {

    public function __construct()
    {
        if (empty($_SESSION['login'])) {
            $this->redirect('/login');
        }
        
    }

    public function index() {
        $data = new GetHandler();

        $saldos = $data->getVal();
        
        $valMes = $data->getValMes();
        
        $dados = array('saldos' => $saldos, 'valores' => $valMes);

        $this->render('home', $dados);
    }

    public function sair() {
        session_destroy();
        $this->redirect('/login');
    }

}