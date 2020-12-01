<?php
namespace src\controllers;

use \core\Controller;
use src\handlers\postHandler;

class DespesasController extends Controller {

    public function __construct()
    {
        if (empty($_SESSION['login'])) {
            $this->redirect('/login');
        }
        
    }

    public function index() {
        $flash = '';
        $css = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $css = $_SESSION['class'];
            $_SESSION['flash'] = '';
            $_SESSION['class'] = '';
        }
        $this->render('despesas', ['flash' => $flash, 'css' => $css]);
    }

    public function registrar() {
        $opcao = filter_input(INPUT_POST, 'radio');
        $data = filter_input(INPUT_POST, 'data');
        $valor = filter_input(INPUT_POST, 'valor');
        $valor = str_replace(",", ".", $valor);
        if (!empty($opcao) && !empty($data) && !empty($valor)) {
            $despesa = new postHandler();
            $resp = $despesa->addDespesa($opcao, $data, $valor);
            if ($resp) {
                $_SESSION['flash'] = 'Registro adicionado com sucesso!';
                $_SESSION['class'] = 'msg-success';
            }            
        } else {
            $_SESSION['flash'] = 'Todos os campos devem ser preenchidos!';
            $_SESSION['class'] = 'msg-danger';
        }

        $this->redirect('/despesas');
    }
}