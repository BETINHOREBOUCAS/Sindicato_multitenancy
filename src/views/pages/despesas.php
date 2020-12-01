<?php $render('header'); ?>

<div class="initial">
    <div class="form">
    <?php if (!empty($flash)) :?>
    <div class="<?=$css;?>"><?=$flash;?></div>
    <?php endif ?>
        <form method="post">
            <div class="form-group-md">
            
                <div style="margin:auto; width: 49%;">
                    <input type="radio" name="radio" value="" checked><b> Escolha Uma Opção Abaixo!</b><br>
                    <input type="radio" name="radio" value="Despesa"> Despesa<br>
                    <input type="radio" name="radio" value="Deposito"> Deposito<br>
                </div>
                <center>
                    <p><b>Adicionar Despesas</b></p>

                    <input type="date" name="data" id="" class="form-control" style="width: 50%; text-align: center;"><br>
                    <input type="text" name="valor" id="" class="form-control" placeholder="Valor" style="width: 50%; text-align: center;"><br>

                    <input type="submit" value="Salvar" id="botao" class="btn btn-success">
                </center>

            </div>
        </form>
    </div>
</div>

<?php $render('footer'); ?>