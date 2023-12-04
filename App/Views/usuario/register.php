<div class="container">
    <h1>Cadastro</h1>
    <p>Por favor, preencha os campos do formulário para criar a sua conta.</p>
    <hr />
    <div class="row">
        <div class="col-md-6" style="padding-left: 40px;">
            <br />
            <?php if ($Sessao::retornaErro()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                        echo $mensagem . "<br />";
                    } ?>
                </div>
            <?php } else {
                $Sessao::limpaFormulario();
            } ?>
            <div class="table-responsive">
                <form action="http://<?php echo APP_HOST; ?>/usuario/registrar" method="post" id="form_cadastro">
                    <input type="hidden" name="tipo" value="user">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" placeholder="Seu nome"
                            value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" name="cpf" placeholder="Seu CPF"
                            value="<?php echo $Sessao::retornaValorFormulario('cpf'); ?>" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="datanasc">Data de Nascimento:</label>
                        <input type="date" class="form-control" name="datanasc" placeholder="Seu datanasc"
                            value="<?php echo $Sessao::retornaValorFormulario('datanasc'); ?>" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select class="form-select" name="sexo"
                            value="<?php echo $Sessao::retornaValorFormulario('sexo'); ?>" required>
                            <option value="">Informe seu sexo</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="N">Prefiro não informar</option>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="whats">WhatsApp:</label>
                        <input type="text" class="form-control" name="whats" placeholder="Seu whats"
                            value="<?php echo $Sessao::retornaValorFormulario('whats'); ?>" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" placeholder="Seu e-mail"
                            value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" placeholder="Sua senha"
                            value="<?php echo $Sessao::retornaValorFormulario('password'); ?>" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="password_confirm">Confirmação da Senha:</label>
                        <input type="password" class="form-control" name="password_confirm"
                            placeholder="Confirmação da senha"
                            value="<?php echo $Sessao::retornaValorFormulario('password_confirm'); ?>" required>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk"
                            aria-hidden="true"></span> Salvar
                    </button>
                    <a href="http://<?php echo APP_HOST; ?>/login" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true">
                        </span> Cancelar
                    </a>
                 
                    <a class="btn btn-primary btn-sm" href="http://<?php echo APP_HOST ?>/endereco/cadastro">
                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true">
                        </span> Cadastrar Endereço
                    </a>


                   

                </form>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>
<br><br>