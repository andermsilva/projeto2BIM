<div class="container">
    <h1>Edição de Usuário</h1>
    <hr>    
    <div class="col-md-9">
        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                    echo $mensagem . "<br />";
                } ?>
            </div>
            <?php } ?>
            
            <form action="http://<?php echo APP_HOST; ?>/usuario/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->getId(); ?>">
            <input type="hidden" class="form-control" name="password" value="<?php echo $viewVar['usuario']->getSenha();; ?>">
            <br />
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $viewVar['usuario']->getNome(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select class="form-select" name="sexo" value="<?php echo $viewVar['usuario']->getSexo(); ?>" required>
                    <option value="">Informe seu sexo</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="N">Prefiro não informar</option>
                </select>
            </div>
            <br />
            <div class="form-group">
                <label for="whats">WhatsApp:</label>
                <input type="text" class="form-control" name="whats" placeholder="" value="<?php echo $viewVar['usuario']->getWhats(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="" value="<?php echo $viewVar['usuario']->getEmail(); ?>" required>
            </div>
            <br />
            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar </button>
            <a href="http://<?php echo APP_HOST; ?>/login/dashboard" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
        </form>
    </div>
    <div class=" col-md-3"></div>
</div>