<?php

namespace src\handlers;

use PDO;
use src\models\ModelPDO;

class postHandler {
    public $pdo;

    public function __construct() {
        $this->pdo = ModelPDO::banco();
    }

    public function addReceita($opcao, $data, $valor) {
        $idUsuario = $_SESSION['login'];
        $sql = $this->pdo->query("INSERT INTO registros (data_registro, valor_registro, tipo_registro, identificador, data_e_hora) values ('$data', '$valor', '$opcao', $idUsuario, now())");
        if ($sql->rowCount() > 0) {
            return true;
        }else {
            return false;
        }
    }

    public function addDespesa($opcao, $data, $valor) {
        $idUsuario = $_SESSION['login'];
        $sql = $this->pdo->query("INSERT INTO registros (data_registro, valor_registro, tipo_registro, identificador, data_e_hora) values ('$data', '$valor', '$opcao', $idUsuario, now())");
        if ($sql->rowCount() > 0) {
            return true;
        }else {
            return false;
        }
    }

    public function excluirRegistro($id) {
        $sql = $this->pdo->query("DELETE FROM registros WHERE id_registro = '$id'");
    }
}