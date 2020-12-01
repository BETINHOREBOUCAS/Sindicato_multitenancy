<?php

namespace src\handlers;

use DateTime;
use DateTimeZone;
use PDO;
use src\models\ModelPDO;


class carteirasHandler {

    public $pdo;

    public function __construct() {
        $this->pdo = ModelPDO::banco();
    }

    public function verificar($ano) {
        $sql = $this->pdo->query("SELECT * FROM tabela_cobranca where ano = $ano");
        $sql = $sql->rowCount();
        return $sql;
    }

    public function AdicionarAno($ano, $valor) {
        $sql = $this->pdo->query("INSERT INTO tabela_cobranca (ano, valor) VALUES ($ano, '$valor')");
    }

   public function getAnoAnterior($busca) {
    $mensalidade_ano_anterior = $this->pdo->query("SELECT * FROM tabela_cobranca WHERE ano = $busca");
    $mensalidade_ano_anterior = $mensalidade_ano_anterior->fetch(PDO::FETCH_ASSOC);
    $mensalidade_ano_anterior = $mensalidade_ano_anterior['valor'];
    return $mensalidade_ano_anterior;
   }

   public function getValoresInterval($anoInicio, $anoFim) {
    $dados = $this->pdo->query("SELECT * FROM tabela_cobranca WHERE ano BETWEEN $anoInicio and $anoFim");
    $dados = $dados->fetchAll(PDO::FETCH_ASSOC);
    return $dados;
   }
}
