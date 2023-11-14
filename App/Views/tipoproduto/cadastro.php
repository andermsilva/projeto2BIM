<div class="container-sm" style="width: 450px;">
    <h2 class="text-center">Cadastro de Tipos</h2>
    <form method="post" action="http://<?php echo APP_HOST; ?>/tipoproduto/salvar" class="flex-d align-items-center bg-info">
        <div class="container3">
            <div class="">
                <label for="nome" class="form-label">Nome do Tipo</label>
                <input type="text" name="nome" class="form-control" id="nome">

            </div>

            <div class="flex-d align-items-center mt-4 py-2 ">

                <button type="submit" class="btn btn-primary">Salvar</button>

                <a href="http://<?php echo APP_HOST; ?>/tipoproduto">
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                </a>
            </div>

        </div>

        <br>


    </form>

</div>