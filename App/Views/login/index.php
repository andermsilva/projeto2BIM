
<?php

use App\Lib\Sessao;

    if (Sessao::retornaMensagem()) {

        echo " <br> <span class='alert alert-warning'>" . Sessao::retornaMensagem() . " <br> </span>";
    }

    ?>

    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                echo $mensagem . "!<br />";
            } ?>
        </div>
    <?php } ?>
<div class="container d-flex flex-row mb-3 p-4 flex-wrap align-content-center justify-content-between">
   

    <div class="" style="width: 500px;">

        <form method="post" action="http://<?php echo APP_HOST ?>/login/autentica" style="width: 300px;">
            <h2 class="text-center">
                Login
            </h2>
            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div>

                <button type="submit" class="btn btn-primary">Entrar</button>
                <br><br>
                <p>Não possui uma conta? <a href="http://<?php echo APP_HOST; ?>/usuario/register">Cadastre-se</a>.</p>
            </div>
            
            <br />

        </form>
    </div>


</div>