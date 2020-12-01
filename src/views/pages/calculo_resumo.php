<?php

use Mpdf\Mpdf;

$data_object = new DateTime();
$dataAtual = $data_object->setTimezone(new DateTimeZone('America/Fortaleza'));
$dataAtual = $dataAtual->format('d/m/Y');

ob_start();
echo $dataAtual;
?>
<h2>Demonstrativo do Valor Devido</h2>
<h4>Data utilizada para calculo: <?=$mesInicio.'/'.$anoInicio.' à '.$mesFim.'/'.$anoFim;?></h4>
<div class="table-principal">
    <div class="div-secundaria">
        <?php if (!empty($_GET['mesi']) && !empty($_GET['mesf']) && !empty($_GET['anoi']) && !empty($_GET['anof'])) : ?>
            <table class="table table-hover table-light">
                <thead style="text-align: center;">
                    <tr>
                        <th>Ano</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php if (isset($valor_primeiro_ano)) : ?>
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
                        <tr>
                            <td><?= $anoFim; ?></td>
                            <td>R$ <?= number_format($valor_ultimo_ano, 2, ',', '.'); ?></td>
                        </tr>
                </tbody>
            <?php else : ?>
                <tr>
                    <td><?= $anoInicio; ?></td>
                    <td>R$ <?= number_format($valorTotal, 2, ',', '.'); ?></td>
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

<div class="desconto">
    <div>Desconto: R$ ________________</div> <br>
    <div>Valor Com Desconto: R$ _______________</div>
</div>
<br>
<br>
<div class="assinatura">
    ____________________________________________ <br>
</div>
<?php
//Vai colocar na variavel tudo que for impresso na tela html e o echo
$html = ob_get_contents();
//FIm do ob
ob_end_clean();

$mpdf = new Mpdf();
$style = file_get_contents($base . '/assets/css/pdf.css');
//Escreve o conteudo
$mpdf->WriteHTML($style, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html);

$mpdf->Output('pdf/arquivo.pdf', 'I');
