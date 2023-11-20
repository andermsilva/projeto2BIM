<?php
namespace App\Controllers;

use App\Lib\Paginacao;
use App\Lib\Sessao;
use App\Models\DAO\PedidoDAO;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\ProdutoPedidoDAO;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Produto;


class PedidoController extends Controller
{
    public function index()
    {
        Sessao::limpaErro();
        Sessao::limpaMensagem();

        $pedidoDAO = new PedidoDAO();

        $busca = isset($_GET['busca']) ? $_GET['busca'] : null;
        $paginaSelecionada = isset($_GET['paginaSelecionada']) ? $_GET['paginaSelecionada'] : 1;
        $totalPorPagina = 5;

        $listPedidos = $pedidoDAO->listaPaginacao($busca, $totalPorPagina, $paginaSelecionada);
        $paginacao = new Paginacao($listPedidos);

        self::setViewParam('busca', $busca);
        self::setViewParam('paginacao', $paginacao->criandoLink($busca, "pedido"));
        self::setViewParam("queryString", Paginacao::criandoQuerystring($paginaSelecionada, $busca));
        self::setViewParam("listaPedidos", $listPedidos["resultado"]);
        self::setViewParam("contagem", $listPedidos["contagem"]);
        $this->render("pedido/index");

        Sessao::limpaErro();
        Sessao::limpaMensagem();

    }


    public function carrinho()
    {
        $car = [];
        $car['cod'] = $_POST['cod'];
        $car['qtd'] = $_POST['qtd'];
        $car['preco'] = $_POST['preco'];


        Sessao::GravarCarrinho($car);

        $this->redirect('/produto');

    }

    public function carrpedido()
    {

        if (isset($_SESSION['carrinho'])) {

            $arr = Sessao::retornarCarrinho();

            $produtoDAO = new ProdutoDAO();
            $arrProd = [];

            foreach ($arr as $prod) {

                $produto = $produtoDAO->getById($prod['cod']);

                $arrayPedido = [];

                $arrayPedido['imagem'] = $produto->getImageUrl();
                $arrayPedido['cod'] = $produto->getCodigo();
                $arrayPedido['nome'] = $produto->getNome();
                $arrayPedido['peso'] = $produto->getPeso();
                $arrayPedido['qtd'] = $prod['qtd'];
                $arrayPedido['valor'] = $prod['qtd'] * $prod['preco'];

                $arrProd[] = $arrayPedido;

            }

            Sessao::gravarListaPedidos($arrProd);
        }
        $this->render('carrinho/index');
    }

    public function alterarPedido($codPedido)
    {

        if ($codPedido) {

            $aux = [];

            foreach ($_SESSION['listaPedidos'] as $produto1) {

                if ($produto1 != null) {
                    if ($produto1['cod'] != $codPedido[0])

                        array_push($aux, $produto1);
                }
            }
        }
        Sessao::gravarListaPedidos($aux);
        $this->render("carrinho/index");

    }

    public function esvaziar()
    {
        Sessao::limparCarrinho();
        Sessao::limparListaPedidos();
        $this->redirect('/home');
    }

    public function verificarPedido()
    {


        $this->render('pedido/finalizar');

    }

    public function salvarPedido()
    {
        $idUser = $_SESSION['iduser'];

        $dados = Sessao::retornarPedidos();

        $pedido = new Pedido();
        $pedidoDAO = new PedidoDAO();
        
        $pedido->getUsuario()->setId($_POST['iduser']);
        $pedido->getTipoPagamento()->setCod($_POST['pgto']);
        $pedido->getEndereco()->setEndCod($_POST['endereco']);
        $pedido->setValor($_POST['total']);

        Sessao::gravarPedido($pedido);

        var_dump($_SESSION['pedido']);

       // Sessao::gravarPedido();

      


        $this->redirect('/pagamento/finalizar');



        /* 
          $dataPedidos = $pedidoDAO->salvar($pedido);

          if($dataPedidos) {

              $items = new ProdutoPedidoDAO();
          }
   */
    }



}
?>