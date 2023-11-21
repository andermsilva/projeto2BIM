<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EnderecoDAO;
use App\Models\DAO\PagamentoDAO;

use App\Models\Entidades\Endereco;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\TipoPagamento;

class PagamentoController extends Controller
{
    public function index()
    {
      if (!$this->auth()) $this->redirect('/login');
                      
      $this->render("pagamento/index");

    }

public function finalizar(){

  $aux = [];
  foreach($_SESSION['pedido'] as $key => $value){
      $aux[$key] = $value;
   }
    //buscar numero do pedido;
    $tp = new TipoPagamento();
    $tp->setCod($aux['tpPgto']);
    $pedido = new Pedido();
    $pedido->setValor($aux['valor']);

   
     /* foreach($_SESSION['listaPedidos'] as $item){

       echo '<br> <hr>';
       foreach($item as $value){
           echo $value." | ";
       }
     }
  */
   
  
  



      
    
  
}
   

}
?>