<?php
namespace src\controllers;

use \core\Controller;
use src\handlers\getHandler;
use src\handlers\postHandler;

class RelatoriosController extends Controller {

    public function __construct()
    {
        if (empty($_SESSION['login'])) {
            $this->redirect('/login');
        }
        
    }

    public function index() {
        $flash = '';
        $registros = '';
        $somas = '';
        $operacao = filter_input(INPUT_GET, 'radio');
        $dataInicio = filter_input(INPUT_GET, 'datai');
        $dataFim = filter_input(INPUT_GET, 'dataf');
        if (!empty($dataInicio) && !empty($dataFim)) {
            $data = new GetHandler();
            $registros = $data->getRelatorio($operacao, $dataInicio, $dataFim);
            $somas = $registros['somas'];
            $registros = array_splice($registros, 1);
            
        } else {
            $flash = 'Todos os campos devem ser preenchido!';
        }
        $this->render('relatorios', ['soma' => $somas, 'relatorios' => $registros, 'flash' => $flash]);
    }

    public function excluirAction($attr) {
        $idRegistro =  $attr['id'];
        $excluir = new postHandler();
        $excluir->excluirRegistro($idRegistro);
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }
}