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
        $produtos = new ProdutoDAO();

        $busca = isset($_GET['busca']) ? $_GET['busca'] : null;
        self::setViewParam("listaProdutos", $produtos->listar());


        $this->render("produto/index");

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
        if (isset($_POST["promo"])){
           
            $promo = true;
        }else{

            $promo = '0';
          
        }

        $tipo = new TipoProduto();
        $tipo->setTipocod($_POST["tipo"]);
        $produto = new Produto();

        $produto->setNome($_POST["nome"]);
        $produto->setDescricao($_POST["decricao"]);
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

        if(!$produto){
            Sessao::gravaMensagem("Produto (codigo:{$codigo}) inexistente.");
            $this->redirect('/produto');
        }

        $fornecedorDAO = new TipoProdutoDAO();

        self::setViewParam('listaFornecedores', $fornecedorDAO->listar());
        self::setViewParam('produto',$produto);
        self::setViewParam('queryString', Paginacao::criandoQuerystring($_GET['paginaSelecionada'], $_GET['busca']));

        $this->render('/produto/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
}
?>