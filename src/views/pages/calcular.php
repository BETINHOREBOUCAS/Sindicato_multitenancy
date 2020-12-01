<?php $render('header'); ?>

<form method="get">
    <div class="somar-principal">
        <div class="select-inicial">
            <h5>Data Inicial:</h5>

            <div class="mes">
                <div>
                    <b><label for="mesi">Mês:</label> </b>
                </div>

                <div>
                    <select name="mesi" id="mesi">
                        <option value=""></option>
                        <option value="1" <?= isset($mesInicio) && $mesInicio == 1 ? 'selected' : ''; ?>>JANEIRO</option>
                        <option value="2" <?= isset($mesInicio) && $mesInicio == 2 ? 'selected' : ''; ?>>FEVEREIRO</option>
                        <option value="3" <?= isset($mesInicio) && $mesInicio == 3 ? 'selected' : ''; ?>>MARÇO</option>
                        <option value="4" <?= isset($mesInicio) && $mesInicio == 4 ? 'selected' : ''; ?>>ABRIL</option>
                        <option value="5" <?= isset($mesInicio) && $mesInicio == 5 ? 'selected' : ''; ?>>MAIO</option>
                        <option value="6" <?= isset($mesInicio) && $mesInicio == 6 ? 'selected' : ''; ?>>JUNHO</option>
                        <option value="7" <?= isset($mesInicio) && $mesInicio == 7 ? 'selected' : ''; ?>>JULHO</option>
                        <option value="8" <?= isset($mesInicio) && $mesInicio == 8 ? 'selected' : ''; ?>>AGOSTO</option>
                        <option value="9" <?= isset($mesInicio) && $mesInicio == 9 ? 'selected' : ''; ?>>SETEMBRO</option>
                        <option value="10" <?= isset($mesInicio) && $mesInicio == 10 ? 'selected' : ''; ?>>OUTUBRO</option>
                        <option value="11" <?= isset($mesInicio) && $mesInicio == 11 ? 'selected' : ''; ?>>NOVEMBRO</option>
                        <option value="12" <?= isset($mesInicio) && $mesInicio == 12 ? 'selected' : ''; ?>>DEZEMBRO</option>
                    </select>
                </div>
            </div>

            <div class="ano">
                <b><label for="anoi">Ano:</label></b>
                <input type="number" name="anoi" id="anoi" min="2004" value="<?= $anoInicio ?? ''; ?>">
            </div>

        </div>

        <div class="select-final">
            <h5>Data Final:</h5>
            <div class="mes">
                <b><label for="mesf">Mês:</label></b>
                <div>
                    <select name="mesf" id="mesf">
                        <option value=""></option>
                        <option value="1" <?= isset($mesFim) && $mesFim == 1 ? 'selected' : ''; ?>>JANEIRO</option>
                        <option value="2" <?= isset($mesFim) && $mesFim == 2 ? 'selected' : ''; ?>>FEVEREIRO</option>
                        <option value="3" <?= isset($mesFim) && $mesFim == 3 ? 'selected' : ''; ?>>MARÇO</option>
                        <option value="4" <?= isset($mesFim) && $mesFim == 4 ? 'selected' : ''; ?>>ABRIL</option>
                        <option value="5" <?= isset($mesFim) && $mesFim == 5 ? 'selected' : ''; ?>>MAIO</option>
                        <option value="6" <?= isset($mesFim) && $mesFim == 6 ? 'selected' : ''; ?>>JUNHO</option>
                        <option value="7" <?= isset($mesFim) && $mesFim == 7 ? 'selected' : ''; ?>>JULHO</option>
                        <option value="8" <?= isset($mesFim) && $mesFim == 8 ? 'selected' : ''; ?>>AGOSTO</option>
                        <option value="9" <?= isset($mesFim) && $mesFim == 9 ? 'selected' : ''; ?>>SETEMBRO</option>
                        <option value="10" <?= isset($mesFim) && $mesFim == 10 ? 'selected' : ''; ?>>OUTUBRO</option>
                        <option value="11" <?= isset($mesFim) && $mesFim == 11 ? 'selected' : ''; ?>>NOVEMBRO</option>
                        <option value="12" <?= isset($mesFim) && $mesFim == 12 ? 'selected' : ''; ?>>DEZEMBRO</option>
                    </select>
                </div>

            </div>

            <div class="ano">
                <b><label for="anof">Ano:</label></b>
                <input type="number" name="anof" id="anof" min="2004" value="<?= $anoFim ?? ''; ?>">
            </div>

        </div>

    </div>
    <div class="btn-calculo"><input type="submit" value="Calcular" class="btn btn-primary"></div>
</form>
<br>
<div class="table-responsive" style="display: flex; justify-content: center;">
    <div style="width: 500px;">
        <?php if (!empty($_GET['mesi']) && !empty($_GET['mesf']) && !empty($_GET['anoi']) && !empty($_GET['anof'])) : ?>
            <table class="table table-hover table-light">
                <thead style="text-align: center;">
                    <tr>
                        <th>Ano</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                <?php if (isset($valor_primeiro_ano)) :?>
                    <tr>
                        <td><?= $anoInicio; ?></td>
                        <td>R$ <?= number_format($valor_primeiro_ano, 2, ',', '.'); ?></td>
                        <?php if (count($dados) <= 2) : ?>
                    </tr>
                <?php endif ?>
                <?php if (count($dados) > 2) : ?>
                    <?php for ($i = 1; $i < count($dados) - 1; $i++) : ?>
                        <?php
                        $valor_janeiro = $dados[$i - 1]['valor'];
                        $valor = (11 * $dados[$i]['valor']) + $valor_janeiro;
                        ?>
                        <tr>
                            <td><?= $dados[$i]['ano']; ?></td>
                            <td>R$ <?= number_format($valor, 2, ',', '.'); ?></td>
                        </tr>
                    <?php endfor ?>
                <?php endif ?>
                <?php if (count($dados) <= 2) : ?>
                    <tr>
                    <?php endif ?>
                    <td><?= $anoFim; ?></td>
                    <td>R$ <?= number_format($valor_ultimo_ano, 2, ',', '.'); ?></td>
                    </tr>
                </tbody>
                <?php else : ?>
                    <tr>
                        <td><?=$anoInicio;?></td>
                        <td>R$  <?=number_format($valorTotal, 2, ',', '.');?></td>
                    </tr>
                <?php endif ?>
                <tfoot style="text-align: center; background-color: #ccc;">
                    <tr>
                        <th>Valor Total</th>
                        <th>R$ <?= number_format($valorTotal, 2, ',', '.'); ?></th>
                    </tr>
                </tfoot>
            </table>
        <?php endif ?>
    </div>
</div>

<?php if (!empty($_GET['mesi']) && !empty($_GET['mesf']) && !empty($_GET['anoi']) && !empty($_GET['anof'])) : ?>
<div style="text-align: center;">
<a href="<?=$base;?>/somar_sindicato/imprimir?mesi=<?=$mesInicio.'&mesf='.$mesFim.'&anoi='.$anoInicio.'&anof='.$anoFim;?>" class="btn btn-secondary" target="_blank">Imprimir</a>
</div>
<?php endif ?>




<?php $render('footer'); ?>