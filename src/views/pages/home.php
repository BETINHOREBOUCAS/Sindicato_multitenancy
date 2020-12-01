<?php $render('header');?>

<div class="container">
    <div class="info">
        <div class="conteudo">
            <div class="anterior">
                <div class="icons">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="text">
                    <div class="desc">Saldo Anterior</div>
                    <div class="valor">R$ <?= $saldos['saldoAnterior']; ?></div>
                </div>
            </div>

            <div class="receitas">
                <div class="icons">
                    <i class="fas fa-arrow-alt-circle-down"></i>
                </div>
                <div class="text">
                    <div class="desc">Receitas</div>
                    <div class="valor">R$ <?= $saldos['receitas']; ?></div>
                </div>
            </div>

        </div>


        <div class="conteudo">
            <div class="despesas">
                <div class="icons">
                    <i class="fas fa-arrow-alt-circle-up"></i>
                </div>
                <div class="text">
                    <div class="desc">Despesas</div>
                    <div class="valor">R$ <?= $saldos['despesas']; ?></div>
                </div>

            </div>

            <div class="saldo">
                <div class="icons">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="text">
                    <div class="desc">Saldo Atual</div>
                    <div class="valor">R$ <?= $saldos['saldoAtual']; ?></div>
                </div>

            </div>
        </div>


    </div>

    <div class="containerGrafico">
        <div class="graficos">
            <div style="width:100%;">
                <canvas id="despesas"></canvas>
            </div>
        </div>
        <div class="graficos">
            <div style="width:100%;">
                <canvas id="receitas"></canvas>
            </div>
        </div>
    </div>

</div>

<?php $mes = 2000; ?>

<script>
    var config = {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abrl', 'Mai', 'Jun', 'Jul', 'Agos', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Ano Anterior',
                backgroundColor: [
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000'
                ],
                borderColor: 'red',
                data: [
                    <?=$valores['despesasAnterior'][1]?>,
                    <?=$valores['despesasAnterior'][2]?>,
                    <?=$valores['despesasAnterior'][3]?>,
                    <?=$valores['despesasAnterior'][4]?>,
                    <?=$valores['despesasAnterior'][5]?>,
                    <?=$valores['despesasAnterior'][6]?>,
                    <?=$valores['despesasAnterior'][7]?>,
                    <?=$valores['despesasAnterior'][8]?>,
                    <?=$valores['despesasAnterior'][9]?>,
                    <?=$valores['despesasAnterior'][10]?>,
                    <?=$valores['despesasAnterior'][11]?>,
                    <?=$valores['despesasAnterior'][12]?>
                ],
                fill: false,
            }, {
                label: 'Ano Atual',
                fill: false,
                backgroundColor: [
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000'
                ],
                borderColor: 'green',
                data: [
                    <?=$valores['despesasAtual'][1]?>,
                    <?=$valores['despesasAtual'][2]?>,
                    <?=$valores['despesasAtual'][3]?>,
                    <?=$valores['despesasAtual'][4]?>,
                    <?=$valores['despesasAtual'][5]?>,
                    <?=$valores['despesasAtual'][6]?>,
                    <?=$valores['despesasAtual'][7]?>,
                    <?=$valores['despesasAtual'][8]?>,
                    <?=$valores['despesasAtual'][9]?>,
                    <?=$valores['despesasAtual'][10]?>,
                    <?=$valores['despesasAtual'][11]?>,
                    <?=$valores['despesasAtual'][12]?>
                ],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Despesas'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Mês'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Valor'
                    }
                }]
            }
        }
    };

    var config2 = {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abrl', 'Mai', 'Jun', 'Jul', 'Agos', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Ano Anterior',
                backgroundColor: [
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000'
                ],
                borderColor: 'red',
                data: [
                    <?=$valores['receitasAnterior'][1]?>,
                    <?=$valores['receitasAnterior'][2]?>,
                    <?=$valores['receitasAnterior'][3]?>,
                    <?=$valores['receitasAnterior'][4]?>,
                    <?=$valores['receitasAnterior'][5]?>,
                    <?=$valores['receitasAnterior'][6]?>,
                    <?=$valores['receitasAnterior'][7]?>,
                    <?=$valores['receitasAnterior'][8]?>,
                    <?=$valores['receitasAnterior'][9]?>,
                    <?=$valores['receitasAnterior'][10]?>,
                    <?=$valores['receitasAnterior'][11]?>,
                    <?=$valores['receitasAnterior'][12]?>
                ],
                fill: false,
            }, {
                label: 'Ano Atual',
                fill: false,
                backgroundColor: [
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000',
                    '#000'
                ],
                borderColor: 'green',
                data: [
                    <?=$valores['receitasAtual'][1]?>,
                    <?=$valores['receitasAtual'][2]?>,
                    <?=$valores['receitasAtual'][3]?>,
                    <?=$valores['receitasAtual'][4]?>,
                    <?=$valores['receitasAtual'][5]?>,
                    <?=$valores['receitasAtual'][6]?>,
                    <?=$valores['receitasAtual'][7]?>,
                    <?=$valores['receitasAtual'][8]?>,
                    <?=$valores['receitasAtual'][9]?>,
                    <?=$valores['receitasAtual'][10]?>,
                    <?=$valores['receitasAtual'][11]?>,
                    <?=$valores['receitasAtual'][12]?>
                ],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Receitas'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Mês'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Valor'
                    }
                }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('despesas').getContext('2d');
        window.myLine = new Chart(ctx, config);
        var ctx = document.getElementById('receitas').getContext('2d');
        window.myLine = new Chart(ctx, config2);
    };
</script>

<?php $render('footer'); ?>