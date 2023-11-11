
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
            </div>
            <br />

        </form>
    </div>
    <div class="bg-info d-none" style="width: 500px;">

        <form method="post" action="http://<?php APP_HOST?>/usuario/registrar" >
            <h2 class="text-center">
                Cadastre-se
            </h2>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="nome" class="form-control" id="nome">
                <input type="hidden" value="user" name="tipo">

            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="cpf" class="form-control" id="cpf">

            </div>
            <div class="mb-3">
                <label for="datanasc" class="form-label">Data Nascimento</label>
                <input type="datanasc" class="form-control" id="datanasc">

            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" name="tipo">
                    <option value="">Informe seu sexo</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="N">Prefiro não informar</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="whatsapp" class="form-label">WhatsApp</label>
                <input type="whatsapp" class="form-control" id="whatsapp">

            </div>
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Senha</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div>

                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
            <br />

        </form>

    </div>

</div>