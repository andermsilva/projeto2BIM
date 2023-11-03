<?php
namespace App\Controllers;

use App\Lib\Paginacao;
use App\Lib\Upload;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\TipoProdutoDAO;
use App\Models\Entidades\Produto;
use App\Models\Entidades\TipoProduto;
use App\Lib\Sessao;
use App\Models\Validacao\ProdutoValidador;

class ProdutoController extends Controller
{

    public function index()
    {
        $produtoDAO = new ProdutoDAO();

        $busca = isset($_GET['busca']) ? $_GET['busca'] : null;
        $paginaSelecionada = isset($_GET['paginaSelecionada']) ? $_GET['paginaSelecionada'] : 1;
        $totalPorPagina = 5;

        $listaProdutos = $produtoDAO->listarPaginacao($busca, $totalPorPagina, $paginaSelecionada);
        $paginacao = new Paginacao($listaProdutos);

        self::setViewParam('busca', $busca);
        self::setViewParam('paginacao', $paginacao->criandoLink($busca, "produto"));
        self::setViewParam("queryString", Paginacao::criandoQuerystring($paginaSelecionada, $busca));
        self::setViewParam("listaProdutos", $listaProdutos["resultado"]);
        $this->render("produto/index");

        Sessao::limpaErro();
        Sessao::limpaMensagem();

    }

    public function cadastro()
    {

        $tipo = new TipoProdutoDAO();
        self::setViewParam("listaTipo", $tipo->listar());
        $this->render("produto/cadastro");

    }

    public function salvar()
    {
        $promo = null;
        if (isset($_POST["promo"])) {

            $promo = true;
        } else {

            $promo = '0';

        }

        $tipo = new TipoProduto();
        $tipo->setTipocod($_POST["tipo"]);
        $produto = new Produto();

        $produto->setNome($_POST["nome"]);
        $produto->setDescricao($_POST["descricao"]);
        $produto->setPreco(str_replace(',', '.', $_POST["preco"]));
        $produto->setPeso(str_replace(',', '.', $_POST["peso"]));
        $produto->setTipoProduto($tipo);
        $produto->setPromo($promo);
        $produto->setImageUrl("");

        Sessao::gravaFormulario($_POST);

        $produtoValidador = new ProdutoValidador();
        $resultadoValidacao = $produtoValidador->validar($produto);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/produto/cadastro');
        }

        try {
            $produtoDAO = new ProdutoDAO();

            $lastId = $produtoDAO->salvar($produto);
            $produto->setCodigo($lastId);
            /*  var_dump($_POST);
             echo '<br>';
             var_dump($_FILES);exit;  */
            if (!empty($_FILES['imagem']['name'])) {

                $objUpload = new Upload($_FILES['imagem']);
                $objUpload->setName('img-id' . $lastId);
                $produto->setImageUrl($objUpload->getBasename());
                $dir = 'public/image/produtos';
                //var_dump($objUpload->upload($dir));exit;


                $sucesso = $objUpload->upload($dir);

                if (!$sucesso) {
                    //echo $sucesso; exit;
                    $resultadoValidacao->addErro('imagem', "Imagem: Problemas ao enviar a imagem do produto. Código de erro: " . $objUpload->getError());
                    Sessao::gravaErro($resultadoValidacao->getErros());
                    $this->redirect('/produto/cadastro');
                }
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();

                Sessao::gravaMensagem("Produto adicionado com sucesso!");
                $produtoDAO->atualizarImagem($produto);
                $this->redirect('/produto');
            }


        } catch (\Exception $e) {

            $this->redirect('/produto');

        }

    }

    public function edicao($params)
    {

        $codigo = $params[0];

        $produtoDAO = new ProdutoDAO();

        $produto = $produtoDAO->getById($codigo);
        $busca = isset($_GET['busca']) ? $_GET['busca'] : null;
        if (!$produto) {
            Sessao::gravaMensagem("Produto (codigo:{$codigo}) inexistente.");
            $this->redirect('/produto');
        }
        $tipoProduto = new TipoProdutoDAO();

        self::setViewParam('listaTipo', $tipoProduto->listar());
        self::setViewParam('produto', $produto);
        self::setViewParam('queryString', Paginacao::criandoQuerystring($_GET['paginaSelecionada'], $busca));

        $this->render('/produto/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {

        $promo = null;
        if (isset($_POST["promo"])) {

            $promo = true;
        } else {

            $promo = '0';

        }
        $produto = new Produto();

        $produto->setCodigo($_POST['cod']);
        $produto->setNome($_POST['nome']);
        $produto->setPreco($_POST['preco']);
        $produto->setPeso($_POST['peso']);
        $produto->setPromo($promo);
        $produto->setDescricao($_POST['descricao']);
        $produto->getTipoProduto()->setTipocod($_POST['tipo']);
        $produto->setImageUrl($_POST['imagem1']);

        Sessao::gravaFormulario($_POST);

        $produtoValidador = new ProdutoValidador();
        $resultadoValidacao = $produtoValidador->validar($produto);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/produto/edicao/' . $_POST['cod']);
        }

        try {

            $dir = 'public/image/produtos';
            $file = $dir . '/' . $_POST['imagem0'];

            if (empty($_POST['imagem1'])) {
                if (file_exists($file))
                    unlink($file);
            }

            if (!empty($_FILES['imagem']['name'])) {
                $objUpload = new Upload($_FILES['imagem']);
                $objUpload->setName('img-id' . $produto->getCodigo());
                $produto->setImageUrl($objUpload->getBasename());

                if (file_exists($file))
                    unlink($file);

                $sucesso = $objUpload->upload($dir);

                if (!$sucesso) {
                    $resultadoValidacao->addErro('imagem', "Imagem: Problemas ao enviar a imagem do produto. Código de erro: " . $objUpload->getError());
                    Sessao::gravaErro($resultadoValidacao->getErros());
                    $this->redirect('/produto' . $_POST['cod'] . '?busca=' . $_GET['busca'] . '&paginaSelecionada=' . $_GET['paginaSelecionada']);
                }
            }

            $produtoDAO = new ProdutoDAO();
            $produtoDAO->atualizar($produto);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/produto');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Produto atualizado com sucesso!");

        $this->redirect('/produto');
    }


    public function exclusao($params)
    {
        $busca = isset($_GET['busca']) ? $_GET['busca'] : null;
        $id = $params[0];
        $produtoDAO = new ProdutoDAO();
        
        $produto = $produtoDAO->getById($id);
        
        if (!$produto) {
            Sessao::gravaMensagem("Produto (id:{$id}) inexistente.");
            $this->redirect('/produto');
        }
        
        self::setViewParam('produto', $produto);
        self::setViewParam('queryString', Paginacao::criandoQuerystring($_GET['paginaSelecionada'],$busca));
        
       
        $this->render('/produto/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $produto = new Produto();
        $produto->setCodigo($_POST['cod']);
        $produto->setNome($_POST['nome']);
        $produto->setImageUrl($_POST['imagem']);

        $produtoDAO = new ProdutoDAO();

        if (!$produtoDAO->excluir($produto)) {
            Sessao::gravaMensagem("Produto (id:{$produto->getCodigo()}) inexistente.");
            $this->redirect('/produto');
        }

        Sessao::gravaMensagem("Produto '{$produto->getNome()}' excluido com sucesso!");

        $this->redirect('/produto');
    }
}


?>