<h2 class="text-center">Cadastro de Produto</h2>
<div class="container">
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                echo $mensagem . "<br />";
            } ?>
        </div>
    <?php } ?>
    <form method="post" action="http://<?php echo APP_HOST; ?>/endereco/gravar">
        <div class="container2">

            <label for="logradouro" class="form-label">Rua</label>
            <input type="text" maxlength="150" class="form-control" id="logradouro"name="logradouro" placeholder="rua">
         
            <label for="numero" class="form-label">Número</label>
            <input type="text" maxlength="12" class="form-control" id="numero"name="numero" placeholder="450">
           
            <label for="comp" class="form-label">Complemento</label>
            <input type="text" maxlength="12" class="form-control" id="comp" name="comp" placeholder="Ap. 52">
           
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" maxlength="30" class="form-control" id="bairro" name="bairro" placeholder="Jd Vale verde">
            
            <label for="cep" class="form-label">Cep</label>
            <input type="text" maxlength="30" class="form-control" id="cep" name="cep" placeholder="1900200">
            
            
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" maxlength="30" class="form-control" id="cidade" name="cidade" placeholder="1900200">
            
            <br>
            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="http://<?php echo APP_HOST; ?>/endereco">
                <button type="button" class="btn btn-secondary">Cancelar</button>
            </a>
        </div>

        <br>


    </form>
</div>