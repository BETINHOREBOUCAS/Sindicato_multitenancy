<?php

namespace src\handlers;

use DateTime;
use DateTimeZone;
use PDO;
use src\models\ModelPDO;


class GetHandler
{

    public $pdo;

    public function __construct()
    {
        $this->pdo = ModelPDO::banco();
    }

    public function logar($user, $password) {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome = :nome");
        $sql->bindValue(':nome', $user);
        $sql->execute();
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        $senha = $sql['senha'];
        
        
        if (password_verify($password, $senha)) {
            $_SESSION['login'] = $sql['id_usuario'];
            return true;
        }
    }

    public function getVal()
    {

        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Fortaleza'));
        $dataAtual = $date->format('Y-m-d');

        $mesAtual = $date->format('m');
        $mesAnterior = $date->format('m') - 1;

        /* Saldo Anterior */

        $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '2020-01-01' and '2020-$mesAnterior-31' and tipo_registro = 'deposito'");
        $saldo3 = $sql->fetch();

        $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '2020-01-01' and '2020-$mesAnterior-31' and tipo_registro = 'despesa'");
        $saldo2 = $sql->fetch();

        $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '2020-01-01' and '2020-$mesAnterior-31' and tipo_registro != 'despesa' and tipo_registro != 'deposito'");
        $saldo1 = $sql->fetch();

        $saldoAnterior = number_format($saldo1[0] - ($saldo2[0] + $saldo3[0]), 2, ",", ".");

        /* FIM */

        /* Soma das Receitas */

        $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '2020-$mesAtual-01' and '$dataAtual' and tipo_registro != 'despesa' AND tipo_registro != 'deposito'");
        $receitas = $sql->fetch();

        $receitas = number_format($receitas[0], 2, ",", ".");

        /* FIM */

        /* Soma das Despesas */

        $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '2020-$mesAtual-01' and '2020-$mesAtual-31' and tipo_registro = 'despesa'");
        $despesas = $sql->fetch();

        $despesas = number_format($despesas[0], 2, ",", ".");

        /* FIM */

        /* Saldo Atual */

        // Depositos
        $somapesquisa1 = "SELECT sum(valor_registro) FROM registros where data_registro between '2020-01-01' and '$dataAtual' and tipo_registro = 'deposito'";
        $somapesquisa1 = $this->pdo->query($somapesquisa1);
        $somapesquisa1 = $somapesquisa1->fetch();
        $d = floatval($somapesquisa1[0]);

        // Despesas
        $somapesquisa3 = "SELECT sum(valor_registro) FROM registros where data_registro between '2020-01-01' and '$dataAtual' and tipo_registro = 'despesa'";
        $somapesquisa3 = $this->pdo->query($somapesquisa3);
        $somapesquisa3 = $somapesquisa3->fetch();
        $i = floatval($somapesquisa3[0]);

        $somapesquisa2 = "SELECT sum(valor_registro) FROM registros where data_registro between '2020-01-01' and '$dataAtual' and tipo_registro != 'despesa' AND tipo_registro != 'deposito'";
        $somapesquisa2 = $this->pdo->query($somapesquisa2);
        $somapesquisa2 = $somapesquisa2->fetch();
        $f = floatval($somapesquisa2[0]);

        $saldoAtual = number_format($f - ($d + $i), 2, ",", ".");

        /* FIM */

        $valores = array(
            'saldoAnterior' => $saldoAnterior,
            'receitas' => $receitas,
            'despesas' => $despesas,
            'saldoAtual' => $saldoAtual
        );

        return $valores;
    }

    public function getValMes()
    {

        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Fortaleza'));
        $anoAtual = $date->format('Y');
        $anoAnterior = $anoAtual - 1;

        for ($i = 1; $i <= 12; $i++) {

            /* Soma das Receitas */

            // Ano anterior

            $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '$anoAnterior-$i-01' and '$anoAnterior-$i-31' and tipo_registro != 'despesa' AND tipo_registro != 'deposito'");
            $receita = $sql->fetch();

            $valores["receitasAnterior"][$i] = number_format($receita[0], 2, ".", "");

            // Ano Atual

            $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '$anoAtual-$i-01' and '$anoAtual-$i-31' and tipo_registro != 'despesa'  AND tipo_registro != 'deposito'");
            $receita = $sql->fetch();

            $valores["receitasAtual"][$i] = number_format($receita[0], 2, ".", "");

            /* FIM */

            /* Soma das Despesas */

            // Ano anterior

            $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '$anoAnterior-$i-01' and '$anoAnterior-$i-31' and tipo_registro = 'despesa'");
            $despesas = $sql->fetch();

            $valores["despesasAnterior"][$i] = number_format($despesas[0], 2, ".", "");

            // Ano Atual

            $sql = $this->pdo->query("SELECT sum(valor_registro) FROM registros where data_registro between '$anoAtual-$i-01' and '$anoAtual-$i-31' and tipo_registro = 'despesa'");
            $despesas = $sql->fetch();

            $valores["despesasAtual"][$i] = number_format($despesas[0], 2, ".", "");

            /* FIM */
        }

        return $valores;
    }

    public function getRelatorio($operacao, $datai, $dataf) {
        if (!empty($operacao)) {
            $sql = $this->pdo->prepare("SELECT * FROM registros where tipo_registro = :operacao AND data_registro between :datai and :dataf ORDER BY data_registro asc");
            $sql->bindValue(":operacao", $operacao);
            $sql->bindValue(":datai", $datai);
            $sql->bindValue(":dataf", $dataf);
            $sql->execute();
            $registros = $sql->fetchAll(PDO::FETCH_ASSOC);
            

            $somaReceitas = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where tipo_registro != 'despesa' AND tipo_registro != 'deposito' and data_registro between :datai and :dataf");
            $somaReceitas->bindValue(":datai", $datai);
            $somaReceitas->bindValue(":dataf", $dataf);
            $somaReceitas->execute();
            $somaReceitas = $somaReceitas->fetch();
            $somaReceitas = $somaReceitas[0];

            $somaDespesas = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where tipo_registro = 'despesa' and data_registro between :datai and :dataf");
            $somaDespesas->bindValue(":datai", $datai);
            $somaDespesas->bindValue(":dataf", $dataf);
            $somaDespesas->execute();
            $somaDespesas = $somaDespesas->fetch();
            $somaDespesas = $somaDespesas[0];

            $somaDepositos = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where tipo_registro = 'deposito' and data_registro between :datai and :dataf");
            $somaDepositos->bindValue(":datai", $datai);
            $somaDepositos->bindValue(":dataf", $dataf);
            $somaDepositos->execute();
            $somaDepositos = $somaDepositos->fetch();
            $somaDepositos = $somaDepositos[0];

            $somaPesquisa = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where tipo_registro = :operacao and data_registro between :datai and :dataf");
            $somaPesquisa->bindValue(":operacao", $operacao);
            $somaPesquisa->bindValue(":datai", $datai);
            $somaPesquisa->bindValue(":dataf", $dataf);
            $somaPesquisa->execute();
            $somaPesquisa = $somaPesquisa->fetch();
            $somaPesquisa = $somaPesquisa[0];

            $valores['somas'] = ['receitas' => $somaReceitas, 'despesas' => $somaDespesas, 'pesquisa' => $somaPesquisa, 'depositos' => $somaDepositos];
            
            foreach ($registros as $value) {
                $idRegistro = $value['id_registro'];
                $dataRegistro = $value['data_registro'];
                $valorRegistro = $value['valor_registro'];
                $tipoRegistro = $value['tipo_registro'];
                $identificador = $value['identificador'];

                $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :nome");
                $sql->bindValue(":nome", $identificador);
                $sql->execute();
                if ($sql->rowCount() == 1) {
                $sql = $sql->fetch();
                $usuario = $sql[1];
                }
                
                $valores[] = array(
                'id_registro' => $idRegistro,
                'data_registro' => $dataRegistro,
                'valor_registro' => $valorRegistro,
                'tipo_registro' => $tipoRegistro,
                'usuario' => $usuario
            );
            }
            
            return $valores;
        } else {
            $sql = $this->pdo->prepare("SELECT * FROM registros where data_registro between :datai and :dataf ORDER BY data_registro asc");
            $sql->bindValue(":datai", $datai);
            $sql->bindValue(":dataf", $dataf);
            $sql->execute();
            $registros = $sql->fetchAll(PDO::FETCH_ASSOC);

            $somaReceitas = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where tipo_registro != 'despesa' AND tipo_registro != 'deposito' and data_registro between :datai and :dataf");
            $somaReceitas->bindValue(":datai", $datai);
            $somaReceitas->bindValue(":dataf", $dataf);
            $somaReceitas->execute();
            $somaReceitas = $somaReceitas->fetch();
            $somaReceitas = $somaReceitas[0];

            $somaDespesas = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where tipo_registro = 'despesa' and data_registro between :datai and :dataf");
            $somaDespesas->bindValue(":datai", $datai);
            $somaDespesas->bindValue(":dataf", $dataf);
            $somaDespesas->execute();
            $somaDespesas = $somaDespesas->fetch();
            $somaDespesas = $somaDespesas[0];

            $somaDepositos = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where tipo_registro = 'deposito' and data_registro between :datai and :dataf");
            $somaDepositos->bindValue(":datai", $datai);
            $somaDepositos->bindValue(":dataf", $dataf);
            $somaDepositos->execute();
            $somaDepositos = $somaDepositos->fetch();
            $somaDepositos = $somaDepositos[0];

            $somaPesquisa = $this->pdo->prepare("SELECT SUM(valor_registro) FROM registros where data_registro between :datai and :dataf");            
            $somaPesquisa->bindValue(":datai", $datai);
            $somaPesquisa->bindValue(":dataf", $dataf);
            $somaPesquisa->execute();
            $somaPesquisa = $somaPesquisa->fetch();
            $somaPesquisa = $somaPesquisa[0];

            $valores['somas'] = ['receitas' => $somaReceitas, 'despesas' => $somaDespesas, 'pesquisa' => $somaPesquisa, 'depositos' => $somaDepositos];
            
            foreach ($registros as $value) {
               
                $idRegistro = $value['id_registro'];
                $dataRegistro = $value['data_registro'];
                $valorRegistro = $value['valor_registro'];
                $tipoRegistro = $value['tipo_registro'];
                $identificador = $value['identificador'];

                $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :nome");
                $sql->bindValue(":nome", $identificador);
                $sql->execute();
                if ($sql->rowCount() == 1) {
                $sql = $sql->fetch();
                $usuario = $sql[1];
                }
                
                $valores[] = array(
                'id_registro' => $idRegistro,
                'data_registro' => $dataRegistro,
                'valor_registro' => $valorRegistro,
                'tipo_registro' => $tipoRegistro,
                'usuario' => $usuario
            );
            }

            return $valores;
        }
        
    }
}
