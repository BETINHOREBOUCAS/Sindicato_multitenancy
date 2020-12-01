<?php $render('header'); ?>

<div class="initial">
    <div class="form">
    <?php if (!empty($flash)) :?>
    <div class="<?=$css;?>"><?=$flash;?></div>
    <?php endif ?>
        <form method="post">
            <div class="form-group-md">
                <div style="margin:auto; width: 49%;">
                    <input type="radio" name="radio" value="1" checked><b> Escolha Uma Opção Abaixo!</b><br>
                    <input type="radio" name="radio" value="Mensalidade"> Mens. Sociais<br>
                    <input type="radio" name="radio" value="Filiação"> Filiação<br>
                    <input type="radio" name="radio" value="Taxa Administração"> Taxa adm<br>
                    <input type="radio" name="radio" value="Xerox"> Xerox <br>
                    <input type="radio" name="radio" value="Cheque"> Cheque <br>
                    <input type="radio" name="radio" value="Base"> Coord. de Base<br><br>
                </div>
                <center>
                    <input type="date" name="data" id="" class="form-control" style="width: 50%; text-align: center;"><br>
                    <input type="text" name="valor" id="" placeholder="Valor" class="form-control" style="width: 50%; text-align: center;"><br>

                    <input type="submit" value="Salvar" id="botao" class="btn btn-success">
                </center>
            </div>

        </form>
    </div>
</div>




<?php $render('footer'); ?>