<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EnderecoDAO;
use App\Models\DAO\PagamentoDAO;
use App\Models\DAO\PedidoDAO;
use App\Models\Entidades\Endereco;
use App\Models\Entidades\Pagamento;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\TipoPagamento;

class PagamentoController extends Controller
{
  public function index()
  {
    if (!$this->auth())
      $this->redirect('/login');



    $this->render("pagamento/index");

  }

  public function pagar($params)
  {
    if (!$this->auth())
      $this->redirect('/login');

    $ped_num = $params[0];
    $pedidoDAO = new PedidoDAO();
    $pag = $pedidoDAO->getByID($ped_num);

    self::setViewParam("listaPedidos", $pag["resultado"]);
    // var_dump($pag);exit;
    $this->render('/pagamento/index');
  }

  public function finalizar()
  {
    
    $pagamento = new Pagamento();

//var_dump($_POST['ped_num']);exit;
    $pagamento->setValor($_POST['valor_total']);
    $pagamento->getPedido()->setPed_num($_POST['ped_num']);
    $pagamento->getTipoPgto()->setCod($_POST['identificador']);

    $pagamentoDAO = new PagamentoDAO();
    

    $pagamentoDAO->salvar($pagamento);
    

     $this->redirect('/home');
    
  }

  


}
?>