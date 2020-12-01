<?php

namespace src\controllers;

use \core\Controller;
use DateTime;
use DateTimeZone;
use src\handlers\carteirasHandler;

class CarteirasController extends Controller
{

    public function __construct()
    {
        $carteiras_object = new carteirasHandler();
        $data_object = new DateTime();
        $anoCorrente = $data_object->setTimezone(new DateTimeZone('America/Fortaleza'));
        $mesCorrente = $anoCorrente->format('m');
        $anoCorrente = $anoCorrente->format('Y');
        if (empty($_SESSION['login'])) {
            $this->redirect('/login');
        }

        if ($mesCorrente >= 2 && $carteiras_object->verificar($anoCorrente) == 0) {
            
?>
            <script src="../public/assets/js/jquery-3.4.1.min.js"></script>
            <script>
                var valor = prompt("Qual o valor da mensalidade do ano corrente?");

                $.ajax({
                    url: '../public/sindicato/add',
                    type: 'GET',
                    data: {
                        valor: valor
                    },
                    success: function() {
                        alert("Valor e ano adicionado!");
                    }
                });
            </script>
<?php


        }
    }

    public function index($attr)
    {
        $carteiras_object = new carteirasHandler();
        $data_object = new DateTime();
        $dataAtual = $data_object->setTimezone(new DateTimeZone('America/Fortaleza'));
        $dataAtual = $dataAtual->format('Y');

        if (!empty($_GET['mesi']) && !empty($_GET['mesf']) && !empty($_GET['anoi']) && !empty($_GET['anof'])) {
            $mesInicio = filter_input(INPUT_GET, 'mesi');
            $mesFim = filter_input(INPUT_GET, 'mesf');
            $anoInicio = filter_input(INPUT_GET, 'anoi');
            $anoFim = filter_input(INPUT_GET, 'anof');

            $mes_inicio_calculo = 13 - $mesInicio;

            if ($dataAtual == $anoInicio) {
                $busca = $anoInicio - 1;

                $mensalidade_ano_anterior = $carteiras_object->getAnoAnterior($busca);
                $dados = $carteiras_object->getValoresInterval($anoInicio, $anoFim);

                $valorTotal = (($mesFim - $mesInicio) * $dados[0]['valor']) + $mensalidade_ano_anterior;
                if (isset($attr['comando']) && $attr['comando'] == 'imprimir') {
                    $this->render('calculo_resumo', [
                        'anoInicio' => $anoInicio,
                        'anoFim' => $anoFim,
                        'mesInicio' => $mesInicio,
                        'mesFim' => $mesFim,
                        'valorTotal' => $valorTotal,
                        'dados' => $dados
                    ]);

                    exit;
                } else {
                    $this->render('calcular', [
                        'anoInicio' => $anoInicio,
                        'anoFim' => $anoFim,
                        'mesInicio' => $mesInicio,
                        'mesFim' => $mesFim,
                        'valorTotal' => $valorTotal,
                        'dados' => $dados
                    ]);

                    exit;
                }
            }

            if ($mesInicio == 1) {
                $busca = $anoInicio - 1;

                $mensalidade_ano_anterior = $carteiras_object->getAnoAnterior($busca);

                $dados = $carteiras_object->getValoresInterval($anoInicio, $anoFim);

                $calculo = 11 * $dados[0]['valor'];
                $valor_primeiro_ano = $calculo + $mensalidade_ano_anterior;
            } else {
                $dados = $carteiras_object->getValoresInterval($anoInicio, $anoFim);

                $valor_primeiro_ano = $mes_inicio_calculo * $dados[0]['valor'];
            }

            $valor_ultimo_ano_janeiro = $dados[count($dados) - 2]['valor'];
            $valor_ultimo_ano_parcial = ($mesFim - 1) * $dados[count($dados) - 1]['valor'];
            $valor_ultimo_ano = $valor_ultimo_ano_janeiro + $valor_ultimo_ano_parcial;

            $valorTotal = $valor_primeiro_ano + $valor_ultimo_ano;

            if (count($dados) > 2) {
                for ($i = 1; $i < count($dados) - 1; $i++) {
                    $valor_janeiro = $dados[$i - 1]['valor'];

                    $valor = (11 * $dados[$i]['valor']) + $valor_janeiro;
                    $valorTotal += $valor;
                }
            }

            if (isset($attr['comando']) && $attr['comando'] == 'imprimir') {
                $this->render('calculo_resumo', [
                    'anoInicio' => $anoInicio,
                    'anoFim' => $anoFim,
                    'mesInicio' => $mesInicio,
                    'mesFim' => $mesFim,
                    'valor_primeiro_ano' => $valor_primeiro_ano,
                    'valor_ultimo_ano' => $valor_ultimo_ano,
                    'valorTotal' => $valorTotal,
                    'dados' => $dados
                ]);

                exit;
            } else {
                $this->render('calcular', [
                    'anoInicio' => $anoInicio,
                    'anoFim' => $anoFim,
                    'mesInicio' => $mesInicio,
                    'mesFim' => $mesFim,
                    'valor_primeiro_ano' => $valor_primeiro_ano,
                    'valor_ultimo_ano' => $valor_ultimo_ano,
                    'valorTotal' => $valorTotal,
                    'dados' => $dados
                ]);
            }
        } else {
            $this->render('calcular');
        }
    }

    public function addAno() {
        $valorAno = filter_input(INPUT_GET, 'valor');        
        $valorAno = str_replace(",", ".", $valorAno);
        if (!empty($valorAno)) {
            $carteiras_object = new carteirasHandler();
            $data_object = new DateTime();
            $anoCorrente = $data_object->setTimezone(new DateTimeZone('America/Fortaleza'));
            $anoCorrente = $anoCorrente->format('Y');

            $carteiras_object->AdicionarAno($anoCorrente, $valorAno);
        }
        
    }
}
