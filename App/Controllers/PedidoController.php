<?php
namespace App\Controllers;

use App\Lib\Paginacao;
use App\Lib\Sessao;
use App\Models\DAO\EnderecoDAO;
use App\Models\DAO\PagamentoDAO;
use App\Models\DAO\PedidoDAO;
use App\Models\DAO\ProdutoDAO;

use App\Models\Entidades\Endereco;
use App\Models\Entidades\Pedido;

use App\Models\Entidades\ProdutoPedido;
use App\Models\Entidades\TipoPagamento;


class PedidoController extends Controller
{
    public function index()
    {


        if (!$this->auth())
            $this->redirect('/login');
 
        
        /* Sessao::limpaErro();
        Sessao::limpaMensagem(); */

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
        +
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
                $arrayPedido['preco'] = $prod['preco'];
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
        Sessao::limpaMensagem();
        Sessao::limpaErro();
        $this->redirect('/home');
    }

    public function verificar($params)
    {
        $num_ped = 0;
        if ($params) {

            $num_ped = $params[0];
        }

        $id = $_SESSION['iduser'];

        if (!$this->auth())
            $this->redirect('/login');

        Sessao::limpaErro();
        Sessao::limpaMensagem();

        $pgt = new TipoPagamento();
        $pedidoDAO = new pedidoDAO();

        $pendencias = $pedidoDAO->pedidosNoPagos($id);

        if ($pendencias['pendencias'] > 0 && isset($_SESSION['carrinho']) && $num_ped == 0) {
            Sessao::limparListaPedidos();
            Sessao::limparCarrinho();
            // echo $num_ped ."<br>";
            Sessao::gravaMensagem("Não foi possivél finalizar seu pedido!");
            //  echo"aqui".$pendencias['pendencias'];exit;
            $this->redirect('/pedido/index');
        }

        $listaEnd = new EnderecoDAO();
        // $ende = new Endereco();


        $vetor1 = $listaEnd->listarPorUsuario($id);
        self::setViewParam('result', $vetor1);

        if ($num_ped) {
            $listaPedido = $pedidoDAO->getById($num_ped);
            //var_dump($listaPedido["resultado"]);exit;
            self::setViewParam("listaPedidos", $listaPedido["resultado"]);
        }


        $vetor = $pedidoDAO->getAllTpgto();

        self::setViewParam("tipos", $vetor['resultado']);



        $this->render('pedido/verificar');

    }

    public function salvarPedido()
    {
        if (!$this->auth())
            $this->redirect('/login');

        $pedido = new Pedido();
        /* 
         $pedido->getUsuario()->setId($_POST['iduser']);
        
         $pedido->getTipoPagamento()->setCod($_POST['pgto']);
         $pedido->getEndereco()->setEndCod($_POST['endereco']);
         $pedido->setValor($_POST['total']); */
        $arrPedido = [];

        $arrPedido['tpPgto'] = $_POST['pgto'];
        $arrPedido['idCli'] = $_POST['iduser'];
        $arrPedido['valor'] = $_POST['total'];
        $arrPedido['ender'] = $_POST['endereco'];
        Sessao::gravarPedido($arrPedido);

        $aux = [];
        foreach ($_SESSION['pedido'] as $key => $item) {
            $aux[$key] = $item;

        }

        $pedido->getTipoPagamento()->setCod($aux['tpPgto']);
        $pedido->getUsuario()->setId($aux['idCli']);
        $pedido->setValor($aux['valor']);
        $pedido->getEndereco()->setEndCod($aux['ender']);

        try {

            $pedidoDAO = new PedidoDAO();

            $numPed = $pedidoDAO->salvar($pedido);

            $pedido->setPed_num($numPed);

            /* echo 'aqui5';
            echo '<hr>'; */


            foreach ($_SESSION['listaPedidos'] as $key => $item) {

                foreach ($item as $k => $valor) {

                    $vetPedido[$k] = $valor;
                }


                $prodPed = new ProdutoPedido();

                $prodPed->getProduto()->setCodigo($vetPedido['cod']);
                $prodPed->getPedido()->setPed_num($pedido->getPed_num());
                $prodPed->setValorUnitario($vetPedido['preco']);
                $prodPed->setQtde($vetPedido['qtd']);
                $prodPed->setSutotal($vetPedido['valor']);

                $pedidoDAO->salvarLista($prodPed);
            }


        } catch (\Exception $e) {

            Sessao::gravaErro($e->getMessage());
            $this->redirect('/pedido/verificar');

        }
        $this->redirect('/pagamento');
    }

    public function cancelar($params)
    {

        $ped_num = $params[0];

        $pedidoDAO = new PedidoDAO();

        if(!$pedidoDAO->excluir($ped_num)){

            Sessao::gravaMensagem("Pedido '{$ped_num}' inexixtente ou ja foi cancelado!");
        }

        Sessao::gravaMensagem("Pedido '{$ped_num}' excluido com sucesso!");

        $this->redirect('/pedido');




    }


public function finalizado($params){

  $ped_num = $params[0];
  $pedidoDAO = new PedidoDAO();
  $pedidoFinalizado = $pedidoDAO->getById($ped_num);
  $end_cod=0;
  $pgCod =0;
  $enderecoDAO = new EnderecoDAO();
  $localEntrega = new Endereco();
  $pagamentoDAO = new PagamentoDAO();
  $formaPG = new TipoPagamento();
 
  foreach(  $pedidoFinalizado['resultado'] as $p){

    foreach($p as $key => $value){

        if($key == 'end_cod'){
            $end_cod = $value;
        }

        if($key == 'pgto_cod'){
            $pgCod = $value;
        }
    }
  }  
  
  $localEntrega = $enderecoDAO->getById($end_cod);
  $formaPG = $pagamentoDAO->getById($pgCod);
 /*  var_dump($localEntrega->getLogradouro());
   exit; */
   self::setViewParam('local',$localEntrega);
   self::setViewParam('pagamento',$formaPG);

   self::setViewParam("pedido",$pedidoFinalizado['resultado']);

   $this->render('pedido/finalizado');
}

}

?>