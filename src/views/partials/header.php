<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="shortcut icon" href="<?= $base; ?>/assets/imagens/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sindicato</title>
    <link rel="stylesheet" href="<?= $base; ?>/assets/css/all.css">
    <link rel="stylesheet" href="<?= $base; ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= $base; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= $base; ?>/assets/css/all.css">
    <link rel="stylesheet" href="<?= $base; ?>/assets/css/receitas.css">

    <script src="<?= $base; ?>/assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?= $base; ?>/assets/js/bootstrap.js"></script>
    <script src="<?= $base; ?>/assets/js/Chart.min.js"></script>
    <script src="<?= $base; ?>/assets/js/script.js"></script>
    <script src="<?= $base; ?>/assets/js/utils.js"></script>
</head>

<body>

    <header>

        <div class="barra-menu">
            <div class="logo left">
                <div>
                  <a href="#"><img src="<?=$base;?>/assets/imagens/logo.png"></a>  
                </div>
                 <div class="texto">
                   Sindicato dos Trabalhadores Rurais Agricultores/as <br> Familiares de Jaguaruana  
                 </div>
                             
            </div>

            <div class="option right">
                <ul class="right">
                    <a href="<?=$base;?>/"><li>Inicio</li></a>
                    <a href="<?=$base;?>/receitas"><li>Receitas</li></a>
                    <a href="<?=$base;?>/despesas"><li>Despesas</li></a>
                    <a href="<?=$base;?>/relatorios"><li>Relatórios</li></a>
                    <a href="<?=$base;?>/somar_sindicato"><li>Calcular Carteira</li></a>
                    <a href="<?=$base;?>/sair"><li>Sair</li></a>
                </ul>
            </div>

            <div class="menu">
            <a href="<?=$base;?>/"><div class="submenu">Inicio</div></a>
            <a href="<?=$base;?>/receitas"><div class="submenu">Receitas</div></a>
            <a href="<?=$base;?>/despesas"><div class="submenu">Despesas</div></a>
            <a href="<?=$base;?>/relatorios"><div class="submenu">Relatórios</div></a>
            <a href="<?=$base;?>/sair"><div class="submenu">Sair</div></a>
            </div>
        </div>
    </header>