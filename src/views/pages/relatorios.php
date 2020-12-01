<?php $render('header'); ?>
<div class="relatorio">
    <div class="container">
        <div class="form">
            <form method="get">
                <div class="form-group">
                    <div style="margin:auto; width: 49%;">
                        <input type="radio" name="radio" value="" <?= (empty($_GET['radio'])) ? 'checked' : ''; ?>> Todas as Receitas e Despesas<br>
                        <input type="radio" name="radio" value="mensalidade" <?= (isset($_GET['radio']) && $_GET['radio'] == 'mensalidade') ? 'checked' : ''; ?>> Mens. Sociais<br>
                        <input type="radio" name="radio" value="despesa" <?= (isset($_GET['radio']) && $_GET['radio'] == 'despesa') ? 'checked' : ''; ?>> Despesas<br>
                        <input type="radio" name="radio" value="filiação" <?= (isset($_GET['radio']) && $_GET['radio'] == 'filiação') ? 'checked' : ''; ?>> Filiação<br>
                        <input type="radio" name="radio" value="taxa" <?= (isset($_GET['radio']) && $_GET['radio'] == 'taxa') ? 'checked' : ''; ?>> Taxa adm<br>
                        <input type="radio" name="radio" value="xerox" <?= (isset($_GET['radio']) && $_GET['radio'] == 'xerox') ? 'checked' : ''; ?>> Xerox<br>
                        <input type="radio" name="radio" value="base" <?= (isset($_GET['radio']) && $_GET['radio'] == 'base') ? 'checked' : ''; ?>> Coord. de Base<br><br>

                        <center>
                            <?php
                            if (!empty($_GET['datai']) && !empty($_GET['datai'])) {
                                $datai = new DateTime($_GET['datai']);
                                $dataf = new DateTime($_GET['dataf']);
                                $datai = $datai->format('Y-m-d');
                                $dataf = $dataf->format('Y-m-d');
                            } else {
                                $datai = '';
                                $dataf = '';
                            }
                            ?>
                            Data Início: <input type="date" name="datai" class="form-control" value="<?= $datai; ?>">
                            Data Fim: <input type="date" name="dataf" class="form-control" value="<?= $dataf; ?>"><br><br>

                        </center>

                        <input type="submit" value="Gerar Relatório" id="botao" class="btn btn-block btn-primary">
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <?php if (isset($relatorios) && !empty($relatorios)) : ?>
                    <?php if (empty($_GET['radio'])) : ?>
                        <table class="table table-hover table-light">
                            <thead style="text-align: center;">
                                <tr>
                                    <th style="background-color:lightcoral;">Despesas</th>
                                    <th style="background-color:lightgreen;">Receitas</th>
                                    <th style="background-color:lightgoldenrodyellow;">Depositos</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                            <tr>                            
                                <td style="background-color:lightcoral;">R$ <?= number_format($soma['despesas'], 2, ",", "."); ?></td>
                                <td style="background-color:lightgreen;">R$ <?= number_format($soma['receitas'], 2, ",", "."); ?></td>
                                <td style="background-color:lightgoldenrodyellow;">R$ <?= number_format($soma['depositos'], 2, ",", "."); ?></td>
                            </tr>
                            </tbody>
                        </table>
                    <?php endif ?>
                    <?php if (!empty($_GET['radio'])) : ?>
                        <table class="table table-hover table-light">
                            <thead style="text-align: center;">
                                <tr>
                                    <th style="background-color:lightsalmon;">Soma da Pesquisa</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <td style="background-color:lightsalmon;">R$ <?= number_format($soma['pesquisa'], 2, ",", "."); ?></td>
                            </tbody>
                        </table>
                    <?php endif ?>
                    <table class="table table-hover table-light">
                        <thead class="thead-dark">
                            <tr style="text-align: center;">
                                <div class="row">
                                    <th style="width: 22%;">Data do Recibo</th>
                                    <th style="width: 22%;">Valor</th>
                                    <th style="width: 22%;">Operação</th>
                                    <th style="width: 22%;">Usuário</th>
                                    <th style="width: 10%;">Ações</th>
                                </div>

                            </tr>
                        </thead>
                        <?php foreach ($relatorios as $value) : ?>
                            <?php
                            $data = $value['data_registro'];
                            $date = new DateTime($data);
                            $data = $date->format('d/m/Y');
                            ?>
                            <tbody>
                            <?php 
                                $idRegistro = $value['id_registro'];
                                $valor = $value['valor_registro'];
                                $registro = $value['tipo_registro'];
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $data; ?></td>
                                    <td style="text-align: center;">R$ <?= number_format($valor, 2, ",", "."); ?></td>
                                    <td style="text-align: center;"><?= ucfirst($registro); ?></td>
                                    <td style="text-align: center;"><?= $value['usuario']; ?></td>
                                    <td style="text-align: center;"><button class="btn btn-danger btn-sm " data-toggle="modal" data-target="#janela" onclick="excluir(<?=$idRegistro;?>, <?=$valor;?>)">Excluir</button></td>
                                </tr>
                            </tbody>
                        <?php endforeach ?>

                    </table>
                <?php endif ?>


                <div class="modal" id="janela">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Excluir Registro</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer" id="botao">
                                
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $render('footer'); ?>